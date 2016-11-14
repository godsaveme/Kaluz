<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Entities\Stock;

class StocksController extends Controller {

    protected $stockRepo;

    public function __construct(StockRepo $stockRepo)
    {
        $this->stockRepo = $stockRepo;
    }

    

    public function all()
    {
        $stocks = $this->stockRepo->paginate(15);
        return response()->json($stocks);
        //var_dump($stocks);
    }

   public function verStockActual($vari,$almacen){
       $stock = $this->stockRepo->encontrar($vari,$almacen);
        return response()->json($stock);
   }
    public function create(Request $request)
    {
        $stocks = $this->stockRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new StationManager($stocks,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.stock',$stock->all());

        return response()->json(['estado'=>true, 'nombre'=>$stocks->nombre]);
    }
      public function edit1(Request $request)
    {
       //var_dump($request->all());die();
        $stock = $this->stockRepo->find($request->stockActualID);
        $request->merge(["stockActual"=>$request->input("stockReal")]);
        $request->merge(["stockMin"=>$stock->stockMin]);
        $request->merge(["stockMinSoles"=>$stock->stockMinSoles]);
        $request->merge(["stockPedidos"=>$stock->stockPedidos]);
        $request->merge(["stockSeparados"=>$stock->stockSeparados]);
        $request->merge(["porLlegar"=>$stock->porLlegar]);
        $request->merge(["variant_id"=>$stock->variant_id]);
        $request->merge(["warehouse_id"=>$stock->warehouse_id]);
        //var_dump($brand);
        //die(); 
        $manager = new StockManager($stock,$request->all());
        $manager->save();

        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
    }
    public function find($id)
    {
        $stock = $this->stockRepo->find($id);
        return response()->json($stock);
    }

    public function edit(Request $request)
    {
      \DB::beginTransaction();
         $var =$request->detailOrderPurchases;
         
         $almacen_id=$request->input("warehouses_id");
         
       foreach($var as $object){
                  //var_dump($object); die();
                  $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
                //var_dump($stockac); var_dump('1');die();
                if($object["esbase"]==0){
                  //antes usando equivalencia$object["stockActual"]=$stockac->stockActual+($object["cantidad"]*$object["equivalencia"]);
                  $object["stockActual"]=$stockac->stockActual+$object["cantidad"];
                }else{
                  $object["stockActual"]=$stockac->stockActual+$object["cantidad"];
                }
                  //$stock = $stockmodel->find($stockac->id);
                  //var_dump($object); var_dump('1');die();
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
                //var_dump($stockac); var_dump('2'); die();
                if($object["esbase"]==0)
                {
                    //$object["stockActual"]=$object["cantidad"]*$object["equivalencia"];
                    $object["stockActual"]=$object["cantidad"];
                }else{
                    $object["stockActual"]=$object["cantidad"];
                }
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }
            $stockac=null;

        }
      \DB::commit();
        return response()->json(['estado'=>true]);
    }

    public function destroy(Request $request)
    {
        $stock= $this->stockRepo->find($request->id);
        $stock->delete();
        //Event::fire('update.stock',$stock->all());
        return response()->json(['estado'=>true, 'nombre'=>$stock->nombre]);
    }

    public function traerStock($product_id){
        //$stock = $this->stockRepo->getModel()->with([])->get();
        $stock = \DB::select( \DB::raw('SELECT variants.codigo, variants.sku, stock.stockActual, stock.warehouse_id,stock.porLlegar, warehouses.nombre
FROM products
INNER JOIN variants ON products.id = variants.product_id
INNER JOIN stock ON variants.id = stock.variant_id
INNER JOIN warehouses ON stock.warehouse_id = warehouses.id
WHERE products.id ='.$product_id.''));
        return response()->json($stock);
    }

   
}