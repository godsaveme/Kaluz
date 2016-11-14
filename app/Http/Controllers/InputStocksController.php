<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Repositories\InputStockRepo;
use Salesfly\Salesfly\Managers\InputStockManager;

use Salesfly\Salesfly\Repositories\HeadInputStockRepo;
use Salesfly\Salesfly\Managers\HeadInputStockManager;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager;
use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\DetPresRepo;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;


class InputStocksController extends Controller
{
    protected $inputStockRepo;
    protected $orderPurchaseRepo;
    protected $detailOrderPurchaseRepo;
    protected $detPresRepo;
    protected $stockRepo;

    public function __construct(HeadInputStockRepo $headInputStockRepo,StockRepo $stockRepo,DetPresRepo $detPresRepo,OrderPurchaseRepo $orderPurchaseRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo,InputStockRepo $inputStockRepo){
        $this->inputStockRepo = $inputStockRepo;
        $this->detPresRepo = $detPresRepo;
        $this->stockRepo = $stockRepo;
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->detailOrderPurchaseRepo = $detailOrderPurchaseRepo;
        $this->headInputStockRepo=$headInputStockRepo;
    }
    public function all(){
        return response()->json($this->equivRepo->all());
    }
    public function equivalencias($id){
    	$presentation = Presentation::find($id);
            $equiv = $presentation->equiv->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product']);

    }
    public function paginate(){
        $inputStock=$this->headInputStockRepo->select();
        return response()->json($inputStock);
    }
    public function paginate2($id){
        $inputStock=$this->inputStockRepo->selected($id);
        return response()->json($inputStock);
    }
    public function paginateFechas($fechaini,$fechafin){
        $inputStock=$this->headInputStockRepo->select2($fechaini,$fechafin);
        return response()->json($inputStock);
    }
     public function paginateTipos($tipo){
        $inputStock=$this->headInputStockRepo->selectporTipos($tipo);
        return response()->json($inputStock);
    }
    public function selectFechaYtipo($fechaini,$fechafin,$tipo){
        $inputStock=$this->headInputStockRepo->selectFechaYtipo($fechaini,$fechafin,$tipo);
        return response()->json($inputStock);
    }
    public function reporttiket($id){
               $database = \Config::get('database.connections.mysql');
               $time=time();
               $output = public_path() . '/report/'.$time.'_TiketParte';        
               $ext = "pdf";
              
               \JasperPHP::process(
                   public_path() . '/report/TiketParte.jasper', 
                   $output, 
                   array($ext),
            //array(),
            //while($i<=3){};

                   ['idVariante'=>intval($id)],//Parametros
              
                   $database,
                   false,
                   false
               )->execute();
               return '/report/'.$time.'_TiketParte.'.$ext;
    }
    
    public function create(Request $request){
      //var_dump($request->input('descripcion'));die();
      \DB::beginTransaction();
      if($request->warehouDestino_id==""){
        $request->merge(["warehouDestino_id"=>null]);
      }
       $var =$request->detailOrderPurchases;
       $request->merge(["Fecha"=>$request->fecha]);
   // var_dump($request->input("generareport"));die();
       $codigoHeadIS;
       $almacen_id=$request->input("warehouses_id");
       $almacen_Destino=$request->input("warehouDestino_id");
       //if($almacen_Destino==null){
       //       $almacen_Destino=null;
       //}
       $queHacer=$request->input("eliminar");
       $tipo=$request->input("tipo");
       $tipo2="Salida";
       $request->merge(['user_id'=>auth()->user()->id]);
       //var_dump();die();
       if($queHacer===0){
        $request->merge(["orderPurchase_id"=>$request->input('id')]);
        $headInputStock = $this->headInputStockRepo->getModel();
        if(!empty($request->input('warehouDestino_id'))){
        $inserHeadInputStock = new HeadInputStockManager($headInputStock,$request->all());
      }else{
        $inserHeadInputStock = new HeadInputStockManager($headInputStock,$request->except('warehouDestino_id'));
      }
            $inserHeadInputStock->save();
            $codigoHeadIS=$headInputStock->id;
       $orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
       $orderPurchase->detPres()->detach();
      
       foreach($var as $object){
      //  if($queHacer===0){
            //var_dump("hola");die();
        $detPres=$this->detPresRepo->listarVariantes($object['detPres_id']);

        $object["variant_id"]=$detPres->variant_id;
        
        $object["warehouses_id"]=$request->input("warehouses_id");
        $object["descripcion"]="Ingreso por pedido";
        $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
        $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
        $insertar->save();
        $detailOrderPurchaseRepox = null;
      // }

        $inputStock = $this->inputStockRepo->getModel();
         // var_dump($object);die();
        if(!empty($object["cantidad_llegado"])){
          
          //if($object["cantidad_llegado"]>0){
          //  if(!empty($object["equivalencia"])){
          //      if($object["equivalencia"]>0){
          //        $object["cantidad_llegado"]=$object["cantidad_llegado"]*$object["equivalencia"];
          //      }
          //   }
            $object['headInputStock_id']=$codigoHeadIS;
            $inserInputStock = new inputStockManager($inputStock,$object);
            $inserInputStock->save();
          
        

        $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  //var_dump($object["tipo"]);die();
            if(!empty($stockac)){ 
               /* if($object["esbase"]==0){
                    if($object["tipo"]=="Salida"){
                        $object["stockActual"]=$stockac->stockActual-($object["cantidad_llegado"]*$object["equivalencia"]);
                        var_dump("entre");
                    }else{
                        $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                     }
                }else{
                    if($object["tipo"]=="Salida"){
                      $object["stockActual"]=$stockac->stockActual-$object["cantidad_llegado"];
                      var_dump("entre");
                    }else{
                       $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"]; 
                    }
                }*/
                //if($object["esbase"]==0){
                //  $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
               // }else{
                  $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"];
                  $object["porLlegar"]=$stockac->porLlegar-$object["cantidad_llegado"];
                //}
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              if($tipo!=$tipo2){
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$object["cantidad_llegado"];
                }
            
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
                  }
            }
            $stockac=null;
        }}

      // }
     }else{

       //==========================================================0
       //$inputStock = $this->inputStockRepo->getModel();
       $headInputStock = $this->headInputStockRepo->getModel();
          //var_dump($var);die();
        //if(!empty($var["cantidad_llegado"])){
            //var_dump($request->all());die();
            $inserHeadInputStock = new HeadInputStockManager($headInputStock,$request->all());
            $inserHeadInputStock->save();
            $codigoHeadIS=$headInputStock->id;
    foreach($var as $object){
          $inputStock = $this->inputStockRepo->getModel();
          //$inputStock = $this->inputStockRepo->getModel();
        if(!empty($object["cantidad_llegado"])){
          if($object["cantidad_llegado"]>0){
            $object['warehouse_id']=$almacen_id;
            $object['headInputStock_id']=$codigoHeadIS;
            $inserInputStock = new InputStockManager($inputStock,$object);
             
            $inserInputStock->save();
          //var_dump($object);die();
        

        $stockmodel = new StockRepo;
                  //$var['warehouse_id']=$almacen_id;
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
            if($tipo=="Transferencia"){
                  $tockacDestino=$stockmodel->encontrar($object["variant_id"],$almacen_Destino);
                   if(!empty($tockacDestino)){ 
               
                if($object["esbase"]==0){
                  $object["stockActual"]=$tockacDestino->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);

                }else{
                  $object["stockActual"]=$tockacDestino->stockActual+$object["cantidad_llegado"];
                  
                }
                 $object['warehouse_id']=$almacen_Destino;
                  $manager = new StockManager($tockacDestino,$object);
                  $manager->save();
                  $stock=null;
            }else{
              
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$object["cantidad_llegado"];
                }
                  $object['warehouse_id']=$almacen_Destino;
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
                  
            }
            $tockacDestino=null;
              if(!empty($stockac)){
                  $object['warehouse_id']=$almacen_id;
                  $object["stockActual"]=$stockac->stockActual-$object["cantidad_llegado"];

                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
              }
            }
            else
            {
           //Actualiza Stock---------------------------------------------       
            if(!empty($stockac)){ 
                
                if($object["esbase"]==0){
                    if($tipo==$tipo2){
                          $object["stockActual"]=$stockac->stockActual-($object["cantidad_llegado"]*$object["equivalencia"]);
                          //var_dump("entre");
                    }else{
                        $object["stockActual"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
                        
                     }
                }else{
                    if($tipo==$tipo2){
                      $object["stockActual"]=$stockac->stockActual-$object["cantidad_llegado"];
                      //var_dump("entre");
                    }else{
                     // var_dump("hola ");die();
                       $object["stockActual"]=$stockac->stockActual+$object["cantidad_llegado"]; 
                       
                    }
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              if($tipo!=$tipo2){
                if($object["esbase"]==0)
                {
                    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                }else{
                    $object["stockActual"]=$object["cantidad_llegado"];
                }
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }}}

            //fin actualiza Stock---------------------------------------------------
            $stockac=null;
        }}}}
       // var_dump($request->generareport);die();
        //$idOrder=intval($request->input("id"));
        //var_dump($idOrder);die();
      
      \DB::commit();
       ////======================================================00
       return response()->json(['estado'=>true]);

    }
    static  function prueba(){
      return "hola mundo";
    }
   
    public function reporteMovimentos($tipo){
      //var_dump("hola commd");die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_MovAlmacen';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/MovAlmacen.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['tipo'=>$tipo,'SUBREPORT_DIR'=> public_path() . '/report/'],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_MovAlmacen.'.$ext;
   
    }
    public function reporteMovimentosFechas($fecha1,$fecha2){
      //var_dump("hola commd".$fecha1."jajaj".$fecha2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_MovientosRagoF';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/MovientosRagoF.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaMenor'=>$fecha1,'fechaMayor'=>$fecha2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_MovientosRagoF.'.$ext;
   
    }
    public function reporteMovimentosFechasTipo($fecha1,$fecha2,$tipo){
      //var_dump("hola commd".$fecha1."jajaj".$fecha2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReporteMovimientoCompleto';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReporteMovimientoCompleto.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaMenor'=>$fecha1,'fechaMayor'=>$fecha2,'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReporteMovimientoCompleto.'.$ext;
   
    }
}