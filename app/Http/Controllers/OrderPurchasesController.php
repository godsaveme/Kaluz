<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager; 

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;
//use Intervention\Image\Facades\Image;

class OrderPurchasesController extends Controller {

    protected $orderPurchaseRepo;

    public function __construct(StockRepo $stockRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo,DetPaymentRepo $detPaymentRepo,PaymentRepo $paymentRepo,PendientAccountRepo $pendientAccountRepo, OrderPurchaseRepo $orderPurchaseRepo)
    {
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
        $this->paymentRepo=$paymentRepo;
        $this->detPaymentRepo=$detPaymentRepo;
        $this->detailOrderPurchaseRepo=$detailOrderPurchaseRepo;
        $this->stockRepo=$stockRepo;
    }

    public function index()
    {
        return View('orderPurchases.index');
    }
      public function show()
    {
        return View('orderPurchases.show');
    }
    public function all($estado)
    {
        $orderPurchases = $this->orderPurchaseRepo->searchEstados($estado);
        return response()->json($orderPurchases);
        //var_dump($orderPurchases);
    }

    public function paginatep(){
        $orderPurchases = $this->orderPurchaseRepo->paginar();
        return response()->json($orderPurchases);
    }


    public function form_create()
    {
        return View('orderPurchases.form_create');
    }
    public function form_createP()
    {
        return View('orderPurchases.form_createP');
    }

    public function form_edit()
    {
        return View('orderPurchases.form_edit');
    }

    public function create(Request $request)
    {
        \DB::beginTransaction();
        $orderPurchase = $this->orderPurchaseRepo->getModel();   
         //var_dump($request->input('montoTotal'));die();    
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10)) ){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }
        
        $orderPurchase->save();


       \DB::commit(); 
        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres,'codigo'=>$orderPurchase->id,'warehouse_id'=>$orderPurchase->warehouses_id]);
    }

    public function find($id)
    {
        $orderPurchase = $this->orderPurchaseRepo->find($id);
        return response()->json($orderPurchase);
    }
    public function mostrarEmpresa($id){
    $orderPurchase=$this->orderPurchaseRepo->traerSumplier($id);
    return response()->json($orderPurchase);
    }
    public function searchFechasEstado($fechaini,$fechafin,$estado){
        $orderPurchase=$this->orderPurchaseRepo->searchFechasEstado($fechaini,$fechafin,$estado);
       return response()->json($orderPurchase);
    }
    public function searchFechas($fechaini,$fechafin){
        $orderPurchase=$this->orderPurchaseRepo->searchFechas($fechaini,$fechafin);
       return response()->json($orderPurchase);
    }
    public function searchFechasLlegadaEstado($fechaini,$fechafin,$estado)
    {
        $orderPurchase=$this->orderPurchaseRepo->searchFechasLlegadaEstado($fechaini,$fechafin,$estado);
       return response()->json($orderPurchase);
    }
     public function searchFechasLlegada($fechaini,$fechafin)
    {
        $orderPurchase=$this->orderPurchaseRepo->searchFechasLlegada($fechaini,$fechafin);
       return response()->json($orderPurchase);
    }
    public function edit(Request $request)
    {
    \DB::beginTransaction();
        $var=$request->input('detailOrderPurchases');
       //var_dump($request->input("warehouses_id"));die(); 
       $almacen_id=$request->input("warehouses_id");
       $orderPurchase = $this->orderPurchaseRepo->find($request->id);
       if($request->Estado == 0){
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
    }else{
       $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista','montoBruto','montoTotal','descuento'));
        $manager->save(); 
    }
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();
       // $verSiExiste=$this->detailOrderPurchaseRepo->Comprobar($request->id);

        //$n=0;
        //->except($request->detailOrderPurchases["id"]);
       //$orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
//==================================Actualizando Detallles==========================
    //if(!empty($verSiExiste[0])){
        //var_dump("no deve entrar");die();
     // $orderPurchase->detPres()->detach();
       /*foreach($var as $object1){
        //$hola=$var[$n];
        if(!empty($object1["cantidad1"])){
            //var_dump("holay".$object1["cantidad1"]);die();
            //$object1["cantidad"]=$object1["Cantidad_Ll"];
            //$object1["pendiente"]=$object1["pendiente"];
            $object1["montoBruto"]=floatval($object1["cantidad"])*floatval($object1["preProducto"]);
            $object1["montoTotal"]=floatval($object1["montoBruto"])-((floatval($object1["montoBruto"])*floatval($object1["descuento"]))/100);
        }else{
            //var_dump("dos".$object1["cantidad1"]);die();
            if($object1["Cantidad_Ll"]=='0' && $object1["montoBruto"]=='0'){
              $object1["Cantidad_Ll"]=0;
              $object1["pendiente"]=$object1["cantidad"];
              $object1["montoBruto"]=floatval($object1["cantidad"])*floatval($object1["preProducto"]);
              $object1["montoTotal"]=floatval($object1["montoBruto"])-((floatval($object1["montoBruto"])*floatval($object1["descuento"]))/100);
            }else{
                if($object1["Cantidad_Ll"]>0){
                     $object1["montoBruto"]=floatval($object1["cantidad"])*floatval($object1["preProducto"]);
                     $object1["montoTotal"]=floatval($object1["montoBruto"])-((floatval($object1["montoBruto"])*floatval($object1["descuento"]))/100);
                }else{  
                     $object1["Cantidad_Ll"]=$object1["cantidad"];
                     $object1["pendiente"]=0;
                     $object1["montoBruto"]=floatval($object1["cantidad"])*floatval($object1["preProducto"]);
                     $object1["montoTotal"]=floatval($object1["montoBruto"])-((floatval($object1["montoBruto"])*floatval($object1["descuento"]))/100);
            }
          }
        }
        
        ////if($hola->cantidad1!=null){
        ////    $object1["Cantidad_Ll"]=$hola->Cantidad_Ll;
        ////    $object1["pendiente"]=$hola->pendiente;
        ////    
        ////}else{
        ////    $object1["Cantidad_Ll"]=$object1["cantidad"];
        ////    $object1["pendiente"]=0;
        ////}
        //var_dump($hola['Cantidad_Ll']);die();
        
        $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
        $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object1);
        $insertar->save();
        $detailOrderPurchaseRepox = null;
        //$n++;
         $stockmodel = new StockRepo;
                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
               var_dump($stockac->porLlegar);die();  
            if(!empty($stockac)){ 
              
               // if($object["esbase"]==0){
                //  $object["porLlegar"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
               // }else{
                  $object["porLlegar"]=$stockac->porLlegar+$object["cantidad"];
                //}
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              //if($tipo!=$tipo2){
               // if($object["esbase"]==0)
               // {
                //    $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                //}else{
                    $object["porLlegar"]=$object["cantidad"];
                //}
            
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
                  }
            //}
            $stockac=null;
       }*/
  // }
  //else{
   foreach($var as $object){
   
          $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
          $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
          $insertar->save();
          $detailOrderPurchaseRepox = null;
          $stockmodel = new StockRepo;

                  $object['warehouse_id']=$almacen_id;
                  $object["variant_id"]=$object["Codigovar"];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$almacen_id);
                  
            if(!empty($stockac)){ 
              
               // if($object["esbase"]==0){
                //  $object["porLlegar"]=$stockac->stockActual+($object["cantidad_llegado"]*$object["equivalencia"]);
               // }else{
                  $object["porLlegar"]=$stockac->porLlegar+$object["cantidad"];
                //}
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  $stock=null;
            }else{
              //if($tipo!=$tipo2){
               // if($object["esbase"]==0)
               // {
                  //  $object["stockActual"]=$object["cantidad_llegado"]*$object["equivalencia"];
                //}else{
                    $object["porLlegar"]=$object["cantidad"];
                //}
            
                  $manager = new StockManager($stockmodel->getModel(),$object);
                  $manager->save();
                  $stockmodel = null;
                  }
            //}
            $stockac=null;
      }
 // }
       //*************************************************************************************
           $verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
  //var_dump($verDeudas[0]->Saldo);die();
      $SaldoAfavor=$request->input('SaldoUtilizado');
      $provicional=null;
      if($verDeudas!=null){
        if($SaldoAfavor>0){
        foreach($verDeudas as $verDeudas){
         // $verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
          
         /* if($provicional==null){
              $payment = $this->paymentRepo->getModel();
              $request->merge(['montoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$verDeudas->Saldo]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=$request->input('montoTotal')-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }*/
           if($verDeudas->Saldo>0 && $SaldoAfavor<=$verDeudas->Saldo){
              $var=$request->detPayments; 
              if($provicional==null){
              $payment = $this->paymentRepo->getModel();
             // $request->merge(['montoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('montoTotal'))-floatval($request->input('Acuenta'));
              //var_dump($request->input('montoTotal'));die();
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->find($provicional);
             // $request->merge(['montoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('montoTotal'))-floatval($request->input('Acuenta'));
              //var_dump($request->input('montoTotal'));die();
              $request->merge(['Saldo'=>$salc]);
              $payment=new PaymentManager($saldos,$request->all());
              $payment->save();
            }             
      // var_dump($var);die();
              $detPayment = $this->detPaymentRepo->getModel();
              $pendientAccountRepo = $this->pendientAccountRepo->getModel();
              $request->merge(['tipoPago'=>'A']);
              $request->merge(['payment_id'=>$provicional]);
              $request->merge(['montoPagado'=>$SaldoAfavor]);
              $request->merge(['methodPayment_id'=>4]);
              $request->merge(['Saldo_F'=>$verDeudas->id]);
              $insertDetP = new DetPaymentManager($detPayment,$request->all());
              $insertDetP->save();
              $request->merge(['Saldo'=>$verDeudas->Saldo-$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$verDeudas->orderPurchase_id]);
              $request->merge(['supplier_id'=>$verDeudas->supplier_id]);
              $updateSaldoF=new pendientAccountManager($verDeudas,$request->all());
              $updateSaldoF->save();
              break;
              //$SaldoAfavor=$verDeudas->Saldo-$request->input('SaldoUtilizado');
      }else{if($verDeudas->Saldo>0){
         $var=$request->detPayments;              
      // var_dump($var);die();
              $SaldoAfavor=$SaldoAfavor-$verDeudas->Saldo;
              if(!empty($provicional)){
              $payment = $this->paymentRepo->getModel();
              //$request->merge(['montoTotal'=>$montotot]);
              $request->merge(['Acuenta'=> $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('montoTotal'))-$request->input('Acuenta');
              //var_dump($request->input('montoTotal'));die();
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->fine($provicional);
             // $request->merge(['montoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+ $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('montoTotal'))-$request->input('Acuenta');
              //var_dump($request->input('montoTotal'));die();
              $request->merge(['Saldo'=>$salc]);
              $payment=new PaymentManager($saldos,$request->all());
              $payment->save();
            }
              $detPayment = $this->detPaymentRepo->getModel();
              $pendientAccountRepo = $this->pendientAccountRepo->getModel();
              $request->merge(['tipoPago'=>'A']);
              $request->merge(['payment_id'=>$provicional]);
              $request->merge(['montoPagado'=>$verDeudas->Saldo]);
              $request->merge(['methodPayment_id'=>4]);
              $request->merge(['Saldo_F'=>$verDeudas->id]);
              $insertDetP = new DetPaymentManager($detPayment,$request->all());
              $insertDetP->save();
              
              $request->merge(['Saldo'=>0]);
              $request->merge(['orderPurchase_id'=>$verDeudas->orderPurchase_id]);
              $request->merge(['supplier_id'=>$verDeudas->supplier_id]);
              $updateSaldoF=new pendientAccountManager($verDeudas,$request->all());
              $updateSaldoF->save();
      }//fin else
     }//fin segundo if
    }//fin for
  }//fin primer if
}//fin if primeross
       //**************************************************************************************
        if($orderPurchase->Estado===2){
                   $payment1 = $this->paymentRepo->paymentById($request->input('id'));
                   $pendientAccount=$this->pendientAccountRepo->getModel();
                   //$pendientAcc=$this->pendientAccountRepo->verSaldos($payment1->id);
              if($payment1!=null){  
                  $detPayment=$this->detPaymentRepo->verPagosAdelantados($payment1->id); 
                if($detPayment!=null){
                  foreach($detPayment as  $detPayment) {
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
                  }else{   
                  $request->merge(['orderPurchase_id'=>$request->input('id')]);
                  $request->merge(['Saldo'=>$payment1->Acuenta]);
                  $insercount=new PendientAccountManager($pendientAccount,$request->all());
                  $insercount->save();
                  $provicional=$request->idpayment;
                }
        }
    }
        \DB::commit(); 
        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres]);
       
       
    }
    public function createDetalle()
    {
        return View('orderPurchases.form_createDetalle');
    }

    public function destroy(Request $request)
    {
        $orderPurchase= $this->orderPurchaseRepo->find($request->id);
        $orderPurchase->delete();
        return response()->json(['estado'=>true, 'nombre'=>$orderPurchase->nombre]);
    }

    public function search($q)
    {
        
        $orderPurchases = $this->orderPurchaseRepo->search($q);

        return response()->json($orderPurchases);
    }
    public function reports($request){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_tikets';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/tikets.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante' => $request->id],//Parametros
              
            $database,
            false,
            false
        )->execute();
    }

    public function reporteEstado($estado){
        //var_dump($estado);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reporteOrderPurchases';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reporteOrderPurchases.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','estado'=>$estado],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reporteOrderPurchases.'.$ext;
    }
    public function reporteRangoFechas($fech1,$fech2){
       // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reporteCompraFechas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reporteCompraFechas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini' => $fech1,'fechafin'=>$fech2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reporteCompraFechas.'.$ext;
    }
    //sin ruta aun
    public function reporteRangoFechaPrevista($fech1,$fech2){
      // var_dump($fech1."/".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportFechaPrevista';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reportFechaPrevista.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini' => $fech1,'fechafin'=>$fech2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reportFechaPrevista.'.$ext;
    }
     public function reporteRangoFechasEstado($fech1,$fech2,$estado){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReporteCompreFechEstad';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReporteCompreFechEstad.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini' => $fech1,'fechafin'=>$fech2,'estado'=>$estado],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReporteCompreFechEstad.'.$ext;
    }
    //sin ruta aun
    public function reporteRangoFechaPrevistaEstado($fech1,$fech2,$estado){
        //var_dump($fech1."//".$fech2);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReportFechaPrevistaEstado';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReportFechaPrevistaEstado.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini' => $fech1,'fechafin'=>$fech2,'estado'=>$estado],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReportFechaPrevistaEstado.'.$ext;
    }
    //sin ruta
      public function reporteOrdenCompreLike($decri){
        //var_dump($estado);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reporteOrdenCompreLike';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/reporteOrdenCompreLike.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','q'=>$decri],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_reporteOrdenCompreLike.'.$ext;
    }
}