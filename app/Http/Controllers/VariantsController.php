<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;

use Salesfly\Salesfly\Entities\Variant;
use Salesfly\Salesfly\Entities\Product;

use Salesfly\Salesfly\Repositories\DetPresRepo;
use Salesfly\Salesfly\Managers\DetPresManager;

use Salesfly\Salesfly\Repositories\AtributRepo;
use Salesfly\Salesfly\Managers\AtributManager;

use Salesfly\Salesfly\Repositories\DetAtrRepo;
use Salesfly\Salesfly\Managers\DetAtrManager;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

use Intervention\Image\Facades\Image;

class VariantsController extends Controller
{
    protected $variantRepo;

    public function __construct(VariantRepo $variantRepo)
    {
        $this->variantRepo = $variantRepo;
    }

    public function index()
    {
        return View('products.index');
    }
    public function searchCodigo($q)
    {
        $variants = $this->variantRepo->searchCodigo($q);

        return response()->json($variants);
    }
    public function find($id)
    {
        $variants = $this->variantRepo->find($id);
        //var_dump($variants);die();
        return response()->json($variants);
    }
    public function  Paginar_por_Variante(){
        $variants=$this->variantRepo->Paginar_por_Variante();
        return response()->json($variants);
    }

        public function getAttr($id)
    {
        $variant = $this->variantRepo->getAttr($id);
        return response()->json($variant);
    }
    /*public function autocomplit($sku){
        $variants = $this->variantRepo->uatocomplit($sku);
    {*/
   /* public function 
        $variant = $this->variantRepo->getAttr($id);
        return response()->json($variant);
    }
*/
    public function traer_por_Sku($sku){
        $variants = $this->variantRepo->traer_por_Sku($sku);
        return response()->json($variants);

    }

    public function paginatep($id,$var){ //->with(['store'])
        $variants = $this->variantRepo->selectByID($id,$var);
        return response()->json($variants);
    }
  public function selectStocksTalla($id,$var,$almac){
     $variants = $this->variantRepo->selectStocksTalla($id,$var,$almac);
        return response()->json($variants);
  }
  public function selectStocksTallaSinTaco($id,$almac){
    $variants = $this->variantRepo->selectStocksTallaSinTaco($id,$almac);
        return response()->json($variants);
  }
    public function form_create()
    {
        //$product = Product::find($product_id);
        return View('variants.form_create');
    }

    public function form_edit()
    {
        return View('variants.form_edit');
    }

    public function create(Request $request)
    {
        //var_dump($request->all()); die();
     \DB::beginTransaction();
        $tallasDisponibles=$request->otros;
        $cantTallas=$request->cantTallas;
        $request->merge(["estado"=>1]);

        //var_dump($request->input('stock')); die();

        $oProd = Product::find($request->input('product_id'));
        
          
        
            //si viene el prod y ademas es prod con variantes
        if(!empty($oProd) && $oProd->hasVariants == 1){
            $n=0;
            //ADD MULTIPLE VARIANTS -------------------------------------------------------------------------
                if($request->input('checkTallas')==true){
            foreach ($tallasDisponibles as $tallasD) {
        //var_dump($tallasD); die();
        $request->merge(["track"=>1]);
        $variant = $this->variantRepo->getModel();


            if($request->input('autogenerado') === true) {
                $sku = \DB::table('variants')->max('sku');
                if (!empty($sku)) {
                    $sku = $sku + 1;
                } else {
                    $sku = 1000; //inicializar el sku;
                }
                $request->merge(array('sku' => $sku));
            }else{

            }
            $request->merge(array('user_id' => Auth()->user()->id));
            
        $managerVar = new VariantManager($variant,$request->except('stock','detAtr','presentation_base_object','presentations'));
        $managerVar->save();

            $oProd->quantVar = $oProd->quantVar + 1;
            $oProd->save();


            //================================ VARIANTES==============================//


            foreach($request->input('presentations') as $presentation){
                $presentation['variant_id'] = $variant->id;
                $presentation['presentation_id'] =  $presentation['id'];
                $oPres = new DetPresRepo();
                $presManager = new DetPresManager($oPres->getModel(),$presentation);
                $presManager->save();
            }

            foreach($request->input('detAtr') as $detAtr){
                if(!empty($detAtr['descripcion'])){
                    $detAtr['variant_id'] = $variant->id;
                    $oDetAtr = new DetAtrRepo();
                    $detAtrManager = new DetAtrManager($oDetAtr->getModel(),$detAtr);
                    $detAtrManager->save();
                }
                if(!empty($tallasD[$n])){

                    if($detAtr['atribute_id']==2)
                    {
                         $detAtr['descripcion']=$tallasD[$n]; 
                         $detAtr['variant_id'] = $variant->id;
                         $oDetAtr = new DetAtrRepo();
                         $detAtrManager = new DetAtrManager($oDetAtr->getModel(),$detAtr);
                         $detAtrManager->save();
                    }
                }
            }

            
                foreach ($request->input('stock') as $stock ) {
                    //var_dump($cantTallas[0]);die();
                    if (isset($stock['stockMin']) && $stock['stockMin'] == null) $stock['stockMin'] = 0;
                    if (isset($stock['stockMinSoles']) && $stock['stockMinSoles'] == null) $stock['stockMinSoles'] = 0;
                    
                    $stock['variant_id'] = $variant->id;
                    $oStock = new StockRepo();
                    $obj = $oStock->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();
                     if(!empty($request->cantTallas[$n])){
                         $stock['stockActual']=$request->cantTallas[$n];
                     }else{
                        if (isset($stock['stockActual']) && $stock['stockActual'] == null) $stock['stockActual'] = 0;
                     }
                    if(!isset($obj->id)){
                        $stockManager = new StockManager($oStock->getModel(), $stock);
                        $stockManager->save();
                    }else{
                        $stockManager = new StockManager($obj, $stock);
                        $stockManager->save();
                    }

                }
            

            //================================ADD IMAGE TO VAR==============================//

            if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
                $image = $request->input('image');
                $mime = $this->get_string_between($image,'/',';');
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                Image::make($image)->resize(200,200)->save('images/variants/'.$variant->id.'.'.$mime);
                $variant->image='/images/variants/'.$variant->id.'.'.$mime;
                $variant->save();
            }else{
                $variant->image='/images/variants/variant.png';
                $variant->save();
            }

            //================================./ADD IMAGE TO VAR==============================//
           $n++;
         }

                    //END ADD MULTIPLE VARIANTS

     }else{
        $variant = $this->variantRepo->getModel();


            if($request->input('autogenerado') === true) {
                $sku = \DB::table('variants')->max('sku');
                if (!empty($sku)) {
                    $sku = $sku + 1;
                } else {
                    $sku = 1000; //inicializar el sku;
                }
                $request->merge(array('sku' => $sku));
            }else{

            }
            $request->merge(array('user_id' => Auth()->user()->id));
            //$request->merge(array('estado' => '0'));
        $managerVar = new VariantManager($variant,$request->except('stock','detAtr','presentation_base_object','presentations'));
        $managerVar->save();

            $oProd->quantVar = $oProd->quantVar + 1;
            $oProd->save();


            //================================ VARIANTES==============================//


            foreach($request->input('presentations') as $presentation){
                $presentation['variant_id'] = $variant->id;
                $presentation['presentation_id'] =  $presentation['id'];
                $oPres = new DetPresRepo();
                $presManager = new DetPresManager($oPres->getModel(),$presentation);
                $presManager->save();
            }

            foreach($request->input('detAtr') as $detAtr){
                if(!empty($detAtr['descripcion'])){

                    $detAtr['variant_id'] = $variant->id;
                    $oDetAtr = new DetAtrRepo();
                    $detAtrManager = new DetAtrManager($oDetAtr->getModel(),$detAtr);
                    $detAtrManager->save();
                }
            }

            if($request->input('track') == 1) {
                foreach ($request->input('stock') as $stock ) {
                    //var_dump($stock['stockActual']);die();
                    if (!isset($stock['stockActual']) || $stock['stockActual'] == NULL ||  $stock['stockActual'] =='') $stock['stockActual'] = 0;
                    if (!isset($stock['stockMin']) || $stock['stockMin'] == NULL ||  $stock['stockMin'] =='') $stock['stockMin'] = 0;
                    if (!isset($stock['stockMinSoles']) || $stock['stockMinSoles'] == NULL ||  $stock['stockMinSoles'] =='') $stock['stockMinSoles'] = 0;
                        $stock['variant_id'] = $variant->id;
                    $oStock = new StockRepo();
                    $obj = $oStock->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();

                    if(!isset($obj->id)){
                        $stockManager = new StockManager($oStock->getModel(), $stock);
                        $stockManager->save();
                    }else{
                        $stockManager = new StockManager($obj, $stock);
                        $stockManager->save();
                    }

                }
            }

            //================================ADD IMAGE TO VAR==============================//

            if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
                $image = $request->input('image');
                $mime = $this->get_string_between($image,'/',';');
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                Image::make($image)->resize(200,200)->save('images/variants/'.$variant->id.'.'.$mime);
                $variant->image='/images/variants/'.$variant->id.'.'.$mime;
                $variant->save();
            }else{
                $variant->image='/images/variants/variant.png';
                $variant->save();
            }
     }
           \DB::commit();
            return response()->json(['estado'=>true, 'nombres'=>$variant->nombre]);
        }else{
            return response()->json(['estado'=>'Prod sin variantes']);
        }

        //================================./VARIANTES==============================//


    }

    public function edit(Request $request){
        \DB::beginTransaction();
        //var_dump($request->all()); die();

        $oProd = Product::find($request->input('product_id'));

        //si viene el prod y ademas es prod con variantes
        if(!empty($oProd) && $oProd->hasVariants == 1){


            $variant = $this->variantRepo->findV($request->input('id'));


            if($request->input('autogenerado') === true) {
                $sku = \DB::table('variants')->max('sku');
                if (!empty($sku)) {
                    $sku = $sku + 1;
                } else {
                    $sku = 1000; //inicializar el sku;
                }
                $request->merge(array('sku' => $sku));
            }else{

            }
            $request->merge(array('user_id' => Auth()->user()->id));
            $managerVar = new VariantManager($variant,$request->except('stock','detAtr','presentation_base_object','presentations'));
            $managerVar->save();

            $oProd->quantVar = $oProd->quantVar + 1;
            $oProd->save();


            //================================ VARIANTES==============================//

            //$variant->presentation()->detach();
            foreach($request->input('presentations') as $presentation){
                $presentation['variant_id'] = $variant->id;
                $presentation['presentation_id'] =  $presentation['id'];

                $oPres = new DetPresRepo();
                //$oStock = $stockRepo->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();
                $obj = $oPres->getModel()->where('variant_id',$presentation['variant_id'])->where('presentation_id',$presentation['presentation_id'])->first();

                if(!isset($obj->id)){
                    $presManager = new DetPresManager($oPres->getModel(), $presentation);
                    $presManager->save();
                }else{
                    $presManager = new DetPresManager($obj, $presentation);
                    $presManager->save();
                }


                //$presManager = new DetPresManager($oPres->getModel(),$presentation);
                //$presManager->save();
            }

            $variant->atributes()->detach();
            foreach($request->input('detAtr') as $detAtr){
                if(!empty($detAtr['descripcion'])){
                    $detAtr['variant_id'] = $variant->id;
                    $oDetAtr = new DetAtrRepo();
                    $detAtrManager = new DetAtrManager($oDetAtr->getModel(),$detAtr);
                    $detAtrManager->save();
                }
            }

            if($request->input('track') == 1) {
                //if (empty($variant->warehouse())) {
                    //var_dump( $variant->stock ); die();
                    //$variant->warehouse()->detach();
                    foreach ($request->input('stock') as $stock) {

                        if (isset($stock['stockActual']) && $stock['stockActual'] == null &&  $stock['stockActual'] =='') $stock['stockActual'] = 0;
                        if (isset($stock['stockMin']) && $stock['stockMin'] == null &&  $stock['stockMin'] =='') $stock['stockMin'] = 0;
                        if (isset($stock['stockMinSoles']) && $stock['stockMinSoles'] == null &&  $stock['stockMinSoles'] =='') $stock['stockMinSoles'] = 0;
                        $stock['variant_id'] = $variant->id;



                        $oStock = new StockRepo();

                        //var_dump($stock['variant_id']);
                        //var_dump($stock['warehouse_id']);

                        $obj = $oStock->getModel()->where('variant_id',$stock['variant_id'])->where('warehouse_id',$stock['warehouse_id'])->first();

                        if(!isset($obj->id)){
                            $stockManager = new StockManager($oStock->getModel(), $stock);
                            $stockManager->save();
                        }else{
                            $stockManager = new StockManager($obj, $stock);
                            $stockManager->save();
                        }

                        //print_r($obj->id); die();


                    }
                //}
            }
            \DB::commit();
            return response()->json(['estado'=>true, 'nombres'=>$variant->nombre]);
        }else{
            return response()->json(['estado'=>'Prod sin variantes']);
        }

        //================================./VARIANTES==============================//

    }

    public function destroy(Request $request)
    {
        //$customer= $this->productRepo->find($request->id);

        \DB::beginTransaction();
        $variant = Variant::find($request->id);
        $product = Product::find($variant->product_id);
        if($product->hasVariants == 1) {
            //$variant = Variant::where('product_id', $product->id)->first();
            $variant->warehouse()->detach();
            $variant->presentation()->detach();
            $variant->atributes()->detach();
            $variant->delete();
            //die();
            //$product->delete();
            //Event::fire('update.customer',$customer->all());
            \DB::commit();
        }
        return response()->json(['estado'=>true, 'nombre'=>$product->nombre]);
    }

    public function disablevar($id){
        \DB::beginTransaction();
        //print_r($id); die();
        $variant = Variant::find($id);
        $estado = $variant->estado;
        if($estado == 1){
            $variant->estado = 0;
        }else{
            $variant->estado = 1;
        }
        $variant->save();
        \DB::commit();
        return response()->json(['estado'=>true]);
    }


    public function findVariant($id)
    {
        $variant = $this->variantRepo->findVariant($id);
        return response()->json($variant);
    }
    public function selectTalla($id,$taco)
    {
        $variant = $this->variantRepo->selectTalla($id,$taco);
        return response()->json($variant);
    }


    public function variants($product_id){

        $product = Product::find($product_id);
        if($product->hasVariants == 1) {
            $variants = $product->variants->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product','detPre' => function($query) use ($product){
                $query->join('presentation','presentation.id','=','detPres.presentation_id')
                ->where('presentation.id',$product->presentation_base);
            },'stock' => function($query){
                $query->where('warehouse_id',1);
            },'user']);
            //echo 'hi';

        }else{
            $variants = null;
        }

        //$variants = Variant::with('atributes')->get();


        return response()->json($variants);
        //return response()->json(Product::find(2)->with('brand')->get());
    }

    public function variant($product_id){

        $oProduct = Product::find($product_id);
        $product = array();

        if($oProduct->hasVariants == 1){
            $product['product'] = $oProduct;
            $product['stock'] = array();
        }else{
            $product = $oProduct->variant->load(['detPre' => function ($query){
                $query->join('presentation','presentation.id','=','detPres.presentation_id');
                //$query->orderBy('id');
            },'stock' => function($q){
                $q->join('warehouses','warehouses.id','=','stock.warehouse_id');
            },'product']);
            //print_r('hoho'); die;
        }

        return response()->json($product);
    }

    public function editFavoritos(Request $request)
    {
        $vatiant = $this->variantRepo->find($request->id);
        //var_dump($vatiant);
        //die();
        $manager = new VariantManager($vatiant,$request->all());
        $manager->save();

        //Event::fire('update.store',$store->all());
        return response()->json(['estado'=>true, 'nombre'=>$vatiant->nombreTienda]);
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
    public function reportes2($id){
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_TiketVariante';        
        $ext = "xls";
        
        \JasperPHP::process(
            public_path() . '/report/TiketVariante.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante'=>intval($id)],//Parametros
           

            $database,
            false,
            false
        )->execute();
        
        return '/report/'.$time.'_TiketVariante.'.$ext;
    }
     public function reportes3($id){
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_TiketVariante2';        
        $ext = "xls";
        
        \JasperPHP::process(
            public_path() . '/report/TiketVariante2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante'=>intval($id)],//Parametros
           

            $database,
            false,
            false
        )->execute();
        
        return '/report/'.$time.'_TiketVariante2.'.$ext;
    }
    /*./ fx ayuda para img*/

    public function actualizarDsctoVar(Request $request){
        //var_dump($request->all()); die();
        \DB::beginTransaction();
        $variant = $this->variantRepo->find($request->input('DsctoProId')); //DStoProID es el id de la variant
        //$variants = $product->variants;

        $detPre = null;
        $dsctCant = null;
        //foreach ($variants as $variant) {
            //var_dump($variant->detPreONE->id);
        $detPre = $variant->detPreONE;
            //var_dump($detPre->id);
        $detPre->dscto = $request->input('DsctoVal');
        $dsctCant = $detPre->price*$request->input('DsctoVal')/100; //pq aun no se guarda el dato;
        $detPre->dsctoCant = $dsctCant;
        $detPre->pvp = $detPre->price -$dsctCant;
        $detPre->save();
        //}

        //$product->dscto = $request->input('DsctoVal');
        //$product->save();

        //die();

        //var_dump(count($variants)); die();

        \DB::commit();
        return response()->json(['estado' => true]);
    }

}
