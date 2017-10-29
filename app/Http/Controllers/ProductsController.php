<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Salesfly\Http\Requests;
use Salesfly\Salesfly\Entities\Product;
use Salesfly\Salesfly\Entities\Variant;
use Salesfly\Salesfly\Managers\DetPresManager;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\DetPresRepo;
use Salesfly\Salesfly\Repositories\ProductRepo;
use Salesfly\Salesfly\Managers\ProductManager;
use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;
use Salesfly\Salesfly\Entities\Brand;
use Salesfly\Salesfly\Entities\Ttype;
use Salesfly\Salesfly\Entities\Material;
use Salesfly\Salesfly\Entities\Station;

use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    protected $productRepo;
    protected $variantRepo;
    protected $detPres;

    public function __construct(ProductRepo $productRepo, VariantRepo $variantRepo, DetPresRepo $detPres)
    {
        $this->productRepo = $productRepo;
        $this->variantRepo = $variantRepo;
        $this->detPres = $detPres;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return View('products.index');
    }

    public function all()
    {
        $products = $this->productRepo->all();
        return response()->json($products);
    }

    public function paginate(){
        $products = $this->productRepo->paginate(15);
        return response()->json($products);
    }

    public function autocomplit(){
         $products = $this->productRepo->Autocomplit();
        return response()->json($products);
    }

    public function pag(){
        $products = $this->productRepo->pag();
        return response()->json($products);
    }

    public function misDatosVariantes($store,$were,$q){
        $products = $this->productRepo->misDatosVariantes($store,$were,$q);
        return response()->json($products);
    }

    public function misDatos($store,$were,$q)
    {
        $products = $this->productRepo->misDatos($store, $were, $q);
        return response()->json($products);
    }

    public function misDatos2($store,$were,$q)
    {
        $products = $this->productRepo->misDatos2($store, $were, $q);
        return response()->json($products);
    }

    public function searchsku($store,$were,$q)
    {
        $products = $this->productRepo->searchsku($store, $were, $q);
        return response()->json($products);
    }

    public function favoritos($store,$were,$q){
        $products = $this->productRepo->favoritos($store,$were,$q);
        return response()->json($products);
    }

    public function variantsAllInventary($store,$were,$q){
        $products = $this->productRepo->variantsAllInventary($store,$were,$q);
        return response()->json($products);
    } 

    public function form_create()
    {
        return View('products.form_create');
    }

    public function form_edit()
    {
        return View('products.form_edit');
    }

    public function create(Request $request)
    {
    \DB::beginTransaction();

        $product = $this->productRepo->getModel();
        $variant = $this->variantRepo->getModel();
        $detPres = $this->detPres->getModel();

        if ($request->input('estado') == 1) {}else{$request->merge(array('estado' => '0'));};
        if ($request->input('hasVariants') == 1) {}else{$request->merge(array('hasVariants' => '0'));};
        if ($request->input('track') == 1) {}else{$request->merge(array('track' => '0'));};

        $request->merge(array('user_id' => Auth()->user()->id));
        //Agrego parámetros globales
        $request->merge(array('store_id' => session('storeId')));
        $request->merge(array('globalType' => session('productTypeId')));
        //./
        $managerPro = new ProductManager($product,$request->except('sku','suppPri','markup','price','track'));

        //================================PROD CON VARIANTES==============================//
        if($request->input('hasVariants') === true){
            $managerPro->save();
            $request->merge(array('product_id' => $product->id));
            $product->quantVar = 0; //cantidad de variantes igual a 0;
            $product->save();
        //================================./PROD CON VARIANTES==============================//


        //================================PROD SIN VARIANTES==============================//
        }elseif($request->input('hasVariants') === '0'){
            $managerPro->save();
            $request->merge(array('product_id' => $product->id));

            if($request->input('autogenerado') === true) {
                $sku = \DB::table('variants')->max('sku');
                if (!empty($sku)) {
                    $sku = $sku + 1;
                } else {
                    $sku = 1000; //inicializar el sku;
                }
                $request->merge(array('sku' => $sku));
            }

            $product->quantVar = 0;
            $product->save();
            $managerVar = new VariantManager($variant,$request->only('sku','suppPri','markup','price','track','product_id','codigo','user_id'));
            $managerVar->save();


                foreach($request->input('presentations') as $presentation){
                    $presentation['variant_id'] = $variant->id;
                    $presentation['presentation_id'] =  $presentation['id'];
                    $oPres = new DetPresRepo();
                    $presManager = new DetPresManager($oPres->getModel(),$presentation);
                    $presManager->save();
                }
                if($request->input('track') == 1) {
                    if(!empty($request->input('stock'))) {
                        foreach ($request->input('stock') as $stock) {
                            if (isset($stock['stockActual']) && $stock['stockActual'] == null) $stock['stockActual'] = 0;
                            if (isset($stock['stockMin']) && $stock['stockMin'] == null) $stock['stockMin'] = 0;
                            if (isset($stock['stockMinSoles']) && $stock['stockMinSoles'] == null) $stock['stockMinSoles'] = 0;
                            $stock['variant_id'] = $variant->id;
                            $stockRepo = new StockRepo();
                            $obj = $stockRepo->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();

                            if(!isset($obj->id)){
                                $stockManager = new StockManager($stockRepo->getModel(), $stock);
                                $stockManager->save();
                            }else{
                                $stockManager = new StockManager($obj, $stock);
                                $stockManager->save();
                            }
                        }
                    }
                }

        }
        //================================./PROD SIN VARIANTES==============================//


        //================================ADD IMAGE TO PROD==============================//
        if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
            $image = $request->input('image');
            $mime = $this->get_string_between($image,'/',';');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
            Image::make($image)->resize(200,200)->save('images/products/'.$product->id.'.'.$mime);
            $product->image='/images/products/'.$product->id.'.'.$mime;
            $product->save();
        }else{
            $product->image='/images/products/product.png';
            $product->save();
        }
        //================================./ADD IMAGE TO PROD==============================//

        \DB::commit();

        return response()->json(['estado'=>true, 'nombres'=>$product->nombre]);
    }

    public function show()
    {
        return View('products.show');
    }

    public function find($id)
    {
        $product = $this->productRepo->find($id);
        //sleep(5);
        return response()->json($product);
    }

    public function edit(Request $request)
    {
        \DB::beginTransaction();

        $product = $this->productRepo->find($request->id);

        if ($request->input('estado') == 1) {}else{$request->merge(array('estado' => '0'));};
        if ($request->input('hasVariants') == 1) {}else{$request->merge(array('hasVariants' => '0'));};
        if ($request->input('track') == 1) {}else{$request->merge(array('track' => '0'));};

        $request->merge(array('user_id' => Auth()->user()->id));

        $managerPro = new ProductManager($product,$request->except('sku','suppPri','markup','price','track'));

        //================================PROD CON VARIANTES==============================//
        if($request->input('hasVariants') === true){
            $managerPro->save();
            $request->merge(array('product_id' => $product->id));
            $product->quantVar = 0; //cantidad de variantes igual a 0;
            $product->save();

        //================================./PROD CON VARIANTES==============================//


        //================================PROD SIN VARIANTES==============================//
        }elseif($request->input('hasVariants') === '0'){
            $managerPro->save();
            $request->merge(array('product_id' => $product->id));

            if($request->input('autogenerado') === true) {
                $sku = \DB::table('variants')->max('sku');
                if (!empty($sku)) {
                    $sku = $sku + 1;
                } else {
                    $sku = 1000; //inicializar el sku;
                }
                $request->merge(array('sku' => $sku));
            }

            $product->quantVar = 0; //aunq presenta una fila en la tabla variantes por defecto
            $product->save();
            $variant = $this->variantRepo->getModel()->where('product_id',$product->id)->first();
            $managerVar = new VariantManager($variant,$request->only('sku','suppPri','markup','price','track','codigo','product_id','user_id'));
            $managerVar->save();

            foreach($request->input('presentations') as $presentation){

                $presentation['variant_id'] = $variant->id;
                $presentation['presentation_id'] =  $presentation['id'];
                $oPres = new DetPresRepo();

                $obj = $oPres->getModel()->where('variant_id',$presentation['variant_id'])->where('presentation_id',$presentation['presentation_id'])->first();

                if(!isset($obj->id)){
                    $presManager = new DetPresManager($oPres->getModel(), $presentation);
                    $presManager->save();
                }else{
                    $presManager = new DetPresManager($obj, $presentation);
                    $presManager->save();
                }
            }

            if($request->input('track') == 1) {

                foreach ($request->input('stock') as $stock) {
                    if (isset($stock['stockActual']) && $stock['stockActual'] == null) $stock['stockActual'] = 0;
                    if (isset($stock['stockMin']) && $stock['stockMin'] == null) $stock['stockMin'] = 0;
                    if (isset($stock['stockMinSoles']) && $stock['stockMinSoles'] == null) $stock['stockMinSoles'] = 0;
                    $stock['variant_id'] = $variant->id;
                    $stockRepo = new StockRepo();
                    $obj = $stockRepo->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();

                    if(!isset($obj->id)){
                        $stockManager = new StockManager($stockRepo->getModel(), $stock);
                        $stockManager->save();
                    }else{
                        $stockManager = new StockManager($obj, $stock);
                        $stockManager->save();
                    }
                }
            }

        }
        //================================./PROD SIN VARIANTES==============================//

        //================================ADD IMAGE TO PROD==============================//

        if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
            $image = $request->input('image');
            $mime = $this->get_string_between($image,'/',';');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
            Image::make($image)->resize(200,200)->save('images/products/'.$product->id.'.'.$mime);
            $product->image='/images/products/'.$product->id.'.'.$mime;
            $product->save();
        }

        //================================./ADD IMAGE TO PROD==============================//

        \DB::commit();

        return response()->json(['estado'=>true, 'nombres'=>$product->nombre]);
    }

    public function destroy(Request $request)
    {

        \DB::beginTransaction();
        $product = Product::find($request->proId);
        if($product->hasVariants == 0 || $product->quantVar==0) {
            $variant = Variant::where('product_id', $product->id)->first();
           if(!empty($variant)){
            $variant->warehouse()->detach();
            $variant->presentation()->detach();
            $variant->delete();
           }
            $product->delete();

            \DB::commit();
        }
        return response()->json(['estado'=>true, 'nombre'=>$product->nombre]);
    }

    public function disableprod($proId){

        \DB::beginTransaction();

        $product = Product::find($proId);
        $estado = $product->estado;

        if($product->hasVariants == 0) {
            $variant = $product->variant;
            if ($estado == 1) {
                $product->estado = 0;
                $variant->estado = 0;

            } else {
                $product->estado = 1;
                $variant->estado = 1;
            }
            $variant->save();
        }else{
            if ($estado == 1) {
                $product->estado = 0;

            } else {
                $product->estado = 1;
            }
        }

        $product->save();

        \DB::commit();

        return response()->json(['estado'=>true]);
    }


    public function brands_select(){
        $brands = Brand::lists('nombre','id');
        return response()->json($brands);
    }

    public function materials_select(){
        $materials = Material::lists('nombre','id');
        return response()->json($materials);
    }

    public function types_select()
    {
        $types = Ttype::lists('nombre','id');
        return response()->json($types);
    }

    public function stations_select(){
        $stations = Station::lists('nombre','id');
        return response()->json($stations);
    }

    public function cantidadProductos(){
        $products = $this->productRepo->cantidadProductos();
        return response()->json($products);
    }

    public function consultCodigo($cod){
        $products = $this->productRepo->consultCodigo($cod);
        return response()->json($products);
    }

    public function consultaProductos($ware)
    {
        $products = $this->productRepo->consultaProductos($ware);
        return response()->json($products);
    }

    public function search($q)
    {
        $customers = $this->productRepo->search($q);
        return response()->json($customers);
    }

    /*fx ayuda para img*/
    public function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

    /*./ fx ayuda para img*/
    public function getAutocomplit2(){

        $product = $this->productRepo->Autocomplit2();
        return response()->json($product);
    }

    public function searchProductAddVariant($q)
    {
        $products = $this->productRepo->searchProductAddVariant($q);
        return response()->json($products);
    }
   
   public function validarNombre($text){
        $product = $this->productRepo->validarNoRepitname($text);
        return response()->json($product);
    }

    public function actualizarDsctoGeneral(Request $request){

        \DB::beginTransaction();
        $product = $this->productRepo->find($request->input('DsctoProId'));
        $variants = $product->variants;

        $detPre = null;
        $dsctCant = null;
        foreach ($variants as $variant) {

            $detPre = $variant->detPreONE;

            $detPre->dscto = (($detPre->price-($detPre->price-$request->input('DsctoVal')))*100)/$detPre->price;

            $dsctCant = $request->input('DsctoVal');        
            $detPre->dsctoCant = $dsctCant;
            $detPre->pvp = $detPre->price -$request->input('DsctoVal');
            $detPre->save();
        }

        $product->dscto = $request->input('DsctoVal');
        $product->save();

        \DB::commit();
        return response()->json(['estado' => true]);
    }
}
