<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PurchaseRepo;
use Salesfly\Salesfly\Managers\PurchaseManager;
use Salesfly\Salesfly\Repositories\DetailPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailPurchaseManager;
use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;

use Salesfly\Salesfly\Repositories\InputStockRepo;
use Salesfly\Salesfly\Managers\InputStockManager;

use Salesfly\Salesfly\Repositories\HeadInputStockRepo;
use Salesfly\Salesfly\Managers\HeadInputStockManager;

use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager; 
//use Intervention\Image\Facades\Image;

class PurchasesController extends Controller {

    protected $purchaseRepo;

   /** public function __construct(PurchaseRepo $purchaseRepo)
    {
        $this->purchaseRepo = $purchaseRepo;
    }*/

    public function __construct(OrderPurchaseRepo $orderPurchaseRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo,HeadInputStockRepo $headInputStockRepo,InputStockRepo $inputStockRepo,DetPaymentRepo $detPaymentRepo,PendientAccountRepo $pendientAccountRepo,PaymentRepo $paymentRepo,DetailPurchaseRepo $detailPurchaseRepo, PurchaseRepo $purchaseRepo,StockRepo $stockRepo)
    {
        $this->detailPurchaseRepo = $detailPurchaseRepo;
        $this->purchaseRepo = $purchaseRepo;
        $this->stockRepo = $stockRepo;
        $this->paymentRepo=$paymentRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
        $this->detPaymentRepo=$detPaymentRepo;
        $this->inputStockRepo=$inputStockRepo;
        $this->headInputStockRepo=$headInputStockRepo;
        $this->detailOrderPurchaseRepo=$detailOrderPurchaseRepo;
        $this->orderPurchaseRepo=$orderPurchaseRepo;
    }

    public function index()
    {
        return View('purchases.index');
    }
    /*public function mostarUltimoagregado(){
        $purchases=$this->purchaseRepo->ultimoDato();
         return response()->json($purchases);
    }*/
    public function all()
    {
        $purchases = $this->purchaseRepo->paginate(15);
        return response()->json($purchases);
        //var_dump($purchases);
    }

    public function paginatep(){
        $purchases = $this->purchaseRepo->paginar(15);
        return response()->json($purchases);
        
    }
   public function form_showD(){
     return View('purchases.showD');
   }
   public function form_cardex(){
     return View('purchases.cardex');
   }

    public function form_create()
    {
        return View('purchases.form_create');
    }
    public function form_createMov()
    {
        return View('purchases.form_createMov');
    }

    public function form_edit()
    {
        return View('purchases.form_edit');
    }
    public function show()
    {
        return View('purchases.show');
    }
    public function create(Request $request)
        {
    \DB::beginTransaction();
        $saldoTemp=0;
        $codigoHeadIS=0;
        $purchase = $this->purchaseRepo->getModel();
        $payment = $this->paymentRepo->getModel();
        $pendientAccount=$this->pendientAccountRepo->getModel();
        $var = $request->detailOrderPurchases;
        $almacen_id=$request->input("warehouses_id");
        if(!empty($request->input("compraDirecta"))){

          foreach($var as $object){
              $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
              if(!empty($stockac)){ 
                  $object["stockActual"]=floatval($stockac->stockActual)+floatval($object["cantidad"]);
                  //var_dump($object["stockActual"]);die();
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
              }else{
                  $object["stockActual"]=$object["cantidad"];
                  //var_dump($object["stockActual"]);die();
                  $manager = new StockManager($stockRepo->getModel,$object);
              }
              $stockac=null;
          }
        }
        
      //==================================Cancelar Factura
      if($request->input('estado')==2){
            // var_dump("hola1");die();
          foreach($var as $object){
              $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
              if(!empty($stockac)){ 
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
              }else{
                  $manager = new StockManager($stockRepo->getModel,$object);
              }
              $stockac=null;
          }

                $orderPurchase = $this->orderPurchaseRepo->find($request->id);
                $ordercompra = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista','montoBruto','montoTotal','descuento'));
                $ordercompra->save(); 
             if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
                   $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
                   $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
             }else{
                  $orderPurchase->fechaPedido = null;
                   $orderPurchase->fechaPrevista = null;
             }
                  $orderPurchase->save();
                  $payment1 = $this->paymentRepo->paymentById($request->input('id'));
                  $pendientAccount=$this->pendientAccountRepo->getModel();
              if(!empty($payment1)){  
                    $detPayment=$this->detPaymentRepo->verPagosAdelantados($payment1->id); 
                    if(!empty($detPayment)){
                    foreach($detPayment as  $detPayment) {
                        $request->merge(["estado"=>0]);
                        $SaldosTemporales =$this->pendientAccountRepo->find2($detPayment['Saldo_F']);
                     if($SaldosTemporales!=null){
                        $request->merge(['Saldo'=>$SaldosTemporales->Saldo+$detPayment['montoPagado']]);
                        $request->merge(['orderPurchase_id'=>$SaldosTemporales->orderPurchase_id]);
                        $request->merge(['supplier_id'=>$SaldosTemporales->supplier_id]);
                        $insercount=new PendientAccountManager($SaldosTemporales,$request->all());
                        $insercount->save();
                     }else{
                        $request->merge(['orderPurchase_id'=>$request->input('id')]);
                        $request->merge(['Saldo'=>$payment1->Acuenta]);
                        $insercount=new PendientAccountManager($pendientAccount,$request->all());
                        $insercount->save();
                     }
                 
                  }
        ///================solucion Errores==================================
                  }else{   
                  $request->merge(['orderPurchase_id'=>$request->input('id')]);
                  $request->merge(['Saldo'=>$payment1->Acuenta]);
                  $insercount=new PendientAccountManager($pendientAccount,$request->all());
                  $insercount->save();
                  $provicional=$request->idpayment;
                }
        //==========================fin
        }
}else
{//var_dump("hola2");die();
        //===================================UpdateOrderPurchase===========================================
      if($request->input('estado')==1){
         $request->merge(["Estado"=>1]);
         $orderPurchase = $this->orderPurchaseRepo->find($request->id);
         $ordercompra = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista','montoBruto','montoTotal','descuento'));
         $ordercompra->save(); 
    if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
             $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();
        $verSiExiste=$this->detailOrderPurchaseRepo->Comprobar($request->id);
        //***************************************************************
        if(!empty($verSiExiste[0])){
        $orderPurchase->detPres()->detach();
        foreach($var as $object1){
               $object1["Cantidad_Ll"]=$object1["cantidad1"];
               $object1["pendiente"]=floatval($object1["cantidad"])-floatval($object1["cantidad1"]);
       
        if(floatval($object1["preCompra"])>0){
               $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
               $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object1);
               $insertar->save();
               $detailOrderPurchaseRepox = null;
        //$n++;
      }
       }
   } }
        //==============================================================================
        
        $codOrder=$request->input("orderPurchase_id");
        $fechaActual=$request->input("fecha");
        //var_dump($fechaActual);die();
        //=============================Creando compra =============================
       //var_dump($var); die();
        $manager = new PurchaseManager($purchase,$request->except('fechaEntrega'));
        $manager->save();

       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $purchase->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $purchase->fechaEntrega = null;
        }

        $purchase->save();
        $temporal=$purchase->id;
       // return $temporal;
        $request->merge(["purchase_id"=>$temporal]);
        $detailPurchaseRepox;
        $consulPayment=null;
        //$almacen_id=$request->input("warehouses_id");
     
      
      //========================================================================
       $total=0;
       foreach($var as $object){
        
        //========================insertDEtalles=========================
           $object['orderPurchase_id']=$codOrder;
           $object['purchases_id'] = $temporal;
           $object['purchase_id']=$temporal;
           $object['Fecha']=$fechaActual;
           $object['warehouse_id']=$almacen_id;
           $object["variant_id"]=$object["Codigovar"];
           $stockmodel = new StockRepo;
           $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
           if($request->input('estado')==1){
           // var_dump($object1["cantidad1"]);
                $cantidadReal=$object["cantidad"];
                $object["cantidad"]=$object["cantidad1"];
                $object["montoBruto"]=floatval($object["cantidad1"])*floatval($object["preProducto"]);
                $object["montoTotal"]=floatval($object["cantidad1"])*floatval($object["preCompra"]);
                $total=$total+$object["montoTotal"];
             
               $cantidaCalculada=floatval($object["cantidad1"])-floatval($object["Cantidad_Ll"]);
               if($cantidaCalculada<0){
                    $cantidaCalculada=floatval($cantidaCalculada*(-1));
               }
                  /*
                  if(!empty($object["cantidad1"])){
                      $cantidaCalculada=floatval($object["cantidad1"])-floatval($object["Cantidad_Ll"]);
                  }else{ 
                    if($object["preCompra"]==0){
                          $cantidaCalculada=floatval($object["cantidad"]);
                    }else{
                         if($object["Cantidad_Ll"]==0 && $object["montoBruto"]==0){
                               $cantidaCalculada=0;
                          }else{
                         $cantidaCalculada=floatval($object["cantidad"])-floatval($object["Cantidad_Ll"]);
                          }
                    }
                  }*/
      //*****************ssss*************************
                   }else{
                         $stockmodel = new StockRepo;
                         $object['warehouse_id']=$almacen_id;
                         $object["variant_id"]=$object["Codigovar"];
                         $cantidaCalculada=$object["cantidad"];
                   }
                   if(intval($object["cantidad"]>0))
                   {
                         $detailPurchaseRepox = new DetailPurchaseRepo;
                         $insertar=new DetailPurchaseManager($detailPurchaseRepox->getModel(),$object);
                         $insertar->save();
                         $detailPurchaseRepox = null;
                   }
        if($request->input('estado')==1){
                    $purchase1 = $this->purchaseRepo->find($temporal);
                    $request->merge(['montoBruto'=>floatval($total)]);
            if(!empty($purchase1->descuento)){
                    $request->merge(['montoTotal'=>floatval($total)-((floatval($total)*floatval($purchase1->descuento))/100)]);
                    if($purchase1->checkIgv==1){
                          $request->merge(['montoBase'=>floatval($request->input('montoTotal'))/1.18]);
                          $request->merge(['igv'=>floatval($request->input('montoTotal'))-(floatval($request->input('montoTotal'))/1.18)]);
                    }else{
                          $request->merge(['montoBase'=>floatval($request->input('montoTotal'))]);
                          $request->merge(['igv'=>floatval($request->input('montoTotal')*1.18)]);
                          $request->merge(['montoTotal'=>floatval($request->input('montoTotal'))+floatval($request->input('igv'))]);
                    }
            }else{
                    $request->merge(['montoTotal'=>floatval($total)]);
                     if($purchase1->checkIgv==1){
                          $request->merge(['montoBase'=>floatval($request->input('montoTotal'))/1.18]);
                          $request->merge(['igv'=>floatval($request->input('montoTotal'))-(floatval($request->input('montoTotal'))/1.18)]);
                    }else{
                          $request->merge(['montoBase'=>floatval($request->input('montoTotal'))]);
                          $request->merge(['igv'=>floatval($request->input('montoTotal')*0.18)]);
                          $request->merge(['montoTotal'=>floatval($request->input('montoTotal'))+floatval($request->input('igv'))]);
                    }
            }
                    $manager = new PurchaseManager($purchase1,$request->except('fechaEntrega'));
                    $manager->save();
        }

        //======================Si Existe Stock Pendiente Por Agregar===============================
        
          $inputStock = $this->inputStockRepo->getModel();
          $object["warehouses_id"]=$request->input("warehouses_id");
          $object["cantidad_llegado"]=$cantidaCalculada;
          $object['descripcion']='Entrada por compra';
          $object['tipo']='Compra';
          if(!empty($cantidadReal)){
          if(floatval($cantidadReal)>0){
           if(!empty($stockac)){ 
                  $object["stockActual"]=$stockac->stockActual+$cantidaCalculada;
                  if($object["Cantidad_Ll"]>0){
                       $object["porLlegar"]=floatval($stockac->porLlegar)-floatval($cantidaCalculada);
                  }else{
                       $object["porLlegar"]=floatval($stockac->porLlegar)-floatval($cantidadReal);
                  }                
               
      //======================Actualizando stock si es que variante existe===============================
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
             
                if(!empty($stockac->porLlegar)){
                    $object["porLlegar"]=floatval($stockac->porLlegar)-floatval($object["cantidad"]);
                }else{
                   $object["porLlegar"]=0;
                }
      //======================Registrando estock si es que variante no existe===============================
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
            }
            $stockac=null;
          }}
          if($cantidaCalculada>0){
          ////======================Registrando en notas de cabecera===============================
               
          if($codigoHeadIS===0 && $cantidaCalculada>0){
               $headInputStock = $this->headInputStockRepo->getModel();
              //var_dump($object);die();
               $object["user_id"]=auth()->user()->id; 
               $inserHeadInputStock = new HeadInputStockManager($headInputStock,$object);
               $inserHeadInputStock->save();
               $codigoHeadIS=$headInputStock->id;
               }
       ////======================Registrando en notas de detalles===============================cantidad_llegado
              //if(!empty($object["equivalencia"])){
              //  if($object["equivalencia"]>0){
              //    $object["cantidad_llegado"]=$object["cantidad_llegado"]*$object["equivalencia"];
              //  }
              //}
              $object['headInputStock_id']=$codigoHeadIS;
              $inserInputStock = new inputStockManager($inputStock,$object);
              $inserInputStock->save();
           
         }
       }
      //======================Creando reporte por cada linea de detalle de compra===============================
       //====================Creando y actualizando pagos si que existe adelantos====================================
        if($request->input('compraDirecta')==1){
                  $request->merge(["Acuenta"=>0]);
                  $inserPay=new PaymentManager($payment,$request->all());
                  $inserPay->save();
          
        }else{
         // var_dump($request->orderPurchase_id);die();
        $consulPayment=$this->paymentRepo->paymentById($request->orderPurchase_id);
        if(!empty($consulPayment)){
         // var_dump("entrando XD");die();
              $request->merge(["Acuenta"=>$consulPayment->Acuenta]);
              $request->merge(["Saldo"=>(floatval($request->input("montoTotal"))-floatval($request->input("Acuenta")))]);
              
                  //$request->merge(["Acuenta"=>0]);
                  $inserPay=new PaymentManager($consulPayment,$request->all());
                  $inserPay->save();
          //------------------------------------
                   
                   if(floatval($request->Saldo)<0){
                         $request->merge(['Saldo'=>floatval($request->Saldo*-1)]);
                         //$request->merge(["estado"=>0]);
                         $insercount=new PendientAccountManager($pendientAccount,$request->except("estado"));
                         $insercount->save();
             
                    }
          

        }else{

              $request->merge(["Acuenta"=>0]);
              $request->merge(["Saldo"=>(floatval($request->input("montoTotal"))-floatval($request->input("Acuenta")))]);
              $inserPay=new PaymentManager($payment,$request->all());
              $inserPay->save();
              //$saldoTemp=$inserPay->Saldo;
        }
      }
      //var_dump("recolectando verdadero salfdo".$consulPayment->Saldo);die();
     // if(!empty($consulPayment)){
     
     // }
       if(!empty($consulPayment)){
        $detPayment=$this->detPaymentRepo->verPagosAdelantados($consulPayment->id);
          if($detPayment!=null){       
          
          foreach($detPayment as $detPayment){

          if($detPayment->Saldo_F!=null){
               $saldos=$this->pendientAccountRepo->find2($detPayment['Saldo_F']);
            if($saldos!=null){
              if($saldos->Saldo==0){                
                 $request->merge(['Saldo'=>0]);
                 $request->merge(['estado'=>1]);
                 $request->merge(['orderPurchase_id'=>$saldos->orderPurchase_id]);
                 $request->merge(['supplier_id'=>$saldos->supplier_id]);
                 $insercount=new PendientAccountManager($saldos,$request->all());
                 $insercount->save();
              }
            }
            }
          }
       }}

        ///==========================Registrando saldo Afavor ========================================

}
      \DB::commit();
     return response()->json(['estado'=>true, 'nombres'=>$purchase->nombres]);
    }
    public function reportes($id){
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_Tiket';        
        $ext = "xls";
        
        \JasperPHP::process(
            public_path() . '/report/Tiket.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante'=>intval($id)],//Parametros
           

            $database,
            false,
            false
        )->execute();
        
        return '/report/'.$time.'_Tiket.'.$ext;
    }
    public function ReportVentas($fecha1,$fecha2){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReporteCajas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReporteCajas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini'=>$fecha1,'fechafin'=>$fecha2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReporteCajas.'.$ext;
    }
     public function reportesCod($id){
     // var_dump("hola commd");die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_CodigoBarras';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/CodigoBarras.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['VarCode'=>$id],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_CodigoBarras.'.$ext;
   
    }
     public function reporteRangoFechas($fech1,$fech2){
       // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_comprasEFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/comprasEFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini' =>$fech1,'fechafin'=>$fech2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_comprasEFechas.'.$ext;
    }
     public function reportepagosProveedor($idPro){
       // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportePagosProveedor';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reporteCompraFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['supplier_id' => $idPro],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportePagosProveedor.'.$ext;
    }
    public function reportepagos($id){

       // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportePagos';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reportePagos.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','payments_id' => $id],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportePagos.'.$ext;
    }
    //pendiente sin ruta
    public function reporteCompraLike($descri){

       // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reporteCompraLike';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reporteCompraLike.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','q' => $descri],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reporteCompraLike.'.$ext;
    }
      public function ReportMejoresEmpleados($fecha1,$fecha2,$can){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_MejoresClientes';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/MejoresClientes.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fecha1,'fechafin'=>$fecha2,'cant'=>$can],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_MejoresClientes.'.$ext;
    }
     public function ReportMejoresCliente($fecha1,$fecha2,$can){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_MejoresClientes2';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/MejoresClientes2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fecha1,'fechafin'=>$fecha2,'cant'=>$can],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_MejoresClientes2.'.$ext;
    }
    public function reportes2($id){
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_TiketVarianteCompras';        
        $ext = "xls";
        
        \JasperPHP::process(
            public_path() . '/report/TiketVarianteCompras.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante'=>intval($id)],//Parametros
           

            $database,
            false,
            false
        )->execute();
        
        return '/report/'.$time.'_TiketVarianteCompras.'.$ext;
    }
    public function reportes3($id){
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_TiketVarianteCompra2';        
        $ext = "xls";
        
        \JasperPHP::process(
            public_path() . '/report/TiketVarianteCompra2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante'=>intval($id)],//Parametros
           

            $database,
            false,
            false
        )->execute();
        
        return '/report/'.$time.'_TiketVarianteCompra2.'.$ext;
    }
    public function find($id)
    {
        $purchase = $this->purchaseRepo->select($id);
        return response()->json($purchase);
    }
    public function paginar1($fecha1,$fecha2){
      $purchase = $this->purchaseRepo->paginar1($fecha1,$fecha2);
        return response()->json($purchase);
    }
    public function mostrarEmpresa($id){
    $purchase=$this->purchaseRepo->traerSumplier($id);
    return response()->json($purchase);
    }

    public function edit(Request $request)
    {
      \DB::beginTransaction();
       $purchase = $this->purchaseRepo->find($request->id);

        $manager = new PurchaseManager($purchase,$request->except('fechaEntrega'));
        $manager->save();
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $purchase->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $purchase->fechaEntrega = null;
        }

        $purchase->save();
        \DB::commit();
        return response()->json(['estado'=>true, 'nombres'=>$purchase->nombres]);
       
       
    }

    public function destroy(Request $request)
    {
        $purchase= $this->purchaseRepo->find($request->id);
        $purchase->delete();
        //Event::fire('update.purchase',$purchase->all());
        return response()->json(['estado'=>true, 'nombre'=>$purchase->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $purchases = $this->purchaseRepo->search($q);

        return response()->json($purchases);
    }
    //===========================================Reporte Cardex=================================
     public function cardexUltimoDia($tipo,$fecha,$tienda){
     // var_dump("hola commd");die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexUltimoDia';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexUltimoDia.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['tipo'=>$tipo,'fecha'=>$fecha,'tienda'=>$tienda],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexUltimoDia.'.$ext;
   
    }
    public function cardexRangoFechas($fechaini,$fechafin,$tipo,$tienda){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexRangoFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexRangoFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['tipo'=>$tipo,'fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda)],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexRangoFechas.'.$ext;
   
    }
     public function cardexTopPrimero($fecha,$tienda,$tipo){
     //var_dump("hola hahahas".$fecha);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTopprimero';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTopprimero.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fecha'=>$fecha,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTopprimero.'.$ext;
   
    }
    public function cardextopUnoRFechas($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexUnoRagoFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexUnoRagoFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexUnoRagoFechas.'.$ext;
   
    }
    public function cardextopUnoRFechasProduct($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexMejorProducts';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexMejorProducts.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexMejorProducts.'.$ext;
   
    }
    public function cardextopmenRFechasProduct($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexPeorProducts';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexPeorProducts.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexPeorProducts.'.$ext;
   
    }
     public function cardexto10masFechasProduct($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTop10RangoFechas2';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTop10RangoFechas2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTop10RangoFechas2.'.$ext;
   
    }
    public function cardexto10menFechasProduct($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTopMen10RangoFechas2';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTopMen10RangoFechas2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTopMen10RangoFechas2.'.$ext;
   
    }
    public function cardexProductsTipeMov($fechaini,$fechafin,$tipo,$tienda,$id){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_CardexProductRangoF';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/CardexProductRangoF.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo,'productId'=>$id],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_CardexProductRangoF.'.$ext;
   
    }

     public function cardextopUnomen($fecha,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportProductMeno';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reportProductMeno.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fecha'=>$fecha,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportProductMeno.'.$ext;
   
    }
    public function cardextopUnomenRFechas($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_productMinRFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/productMinRFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>$tienda,'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_productMinRFechas.'.$ext;
   
    }
     public function cardextop10mejores($fecha,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTop10Mejores';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTop10Mejores.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fecha'=>$fecha,'tienda'=>$tienda,'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTop10Mejores.'.$ext;
   
    }
    public function cardextop10mejoreRFechas($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTop10RangoFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTop10RangoFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>$tienda,'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTop10RangoFechas.'.$ext;
   
    }
    public function cardextop10Peores($fecha,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexTop10Peores';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexTop10Peores.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fecha'=>$fecha,'tienda'=>$tienda,'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexTop10Peores.'.$ext;
   
    }
    public function cardextop10peoresFechas($fechaini,$fechafin,$tienda,$tipo){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardextop10PeoreRFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardextop10PeoreRFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardextop10PeoreRFechas.'.$ext;
   
    }
    public function reportMovimientoVarianteDMA($tipo,$fecha,$tienda,$var){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportMovimientoVarianteDMA';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reportMovimientoVarianteDMA.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['tipo'=>$tipo,'fecha'=>$fecha,'tienda'=>intval($tienda),'variant_id'=>intval($var)],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportMovimientoVarianteDMA.'.$ext;
   
    }
    public function reportMovimientosVarianteRangoF($fechaini,$fechafin,$tipo,$tienda,$var){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportMovimientosVarianteRangoF';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reportMovimientosVarianteRangoF.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin,'variant_id'=>intval($var),'tienda'=>intval($tienda),'tipo'=>$tipo],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportMovimientosVarianteRangoF.'.$ext;
   
    }
     public function ReportDetCashesResumido($f1,$f2){
           $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReportDetCashmes';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReportDetCashmes.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini'=>$f1,'fechafin'=>$f2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReportDetCashmes.'.$ext;
     }
      public function ReportDetCashesDetallado($f1,$f2){
           $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReportDetCashMenusal';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReportDetCashMenusal.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
             ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini'=>$f1,'fechafin'=>$f2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReportDetCashMenusal.'.$ext;
     }
     public function cardexPagoProveedores($fechaini,$fechafin){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReportePagoProveedores';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReportePagoProveedores.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fechaini,'fechafin'=>$fechafin],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReportePagoProveedores.'.$ext;
   
    }
    //=============================================fin reportCardex=============================
    
}