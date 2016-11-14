<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;
use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\CashMonthlyRepo;
use Salesfly\Salesfly\Managers\CashMonthlyManager;

use Salesfly\Salesfly\Repositories\YearRepo;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

class DetPaymentsController extends Controller {

    protected $detPaymentRepo;

    public function __construct(PendientAccountRepo $pendientAccountRepo,YearRepo $yearRepo,CashMonthlyRepo $cashMonthlyRepo,CashRepo $cashRepo,DetCashRepo $detCashRepo,DetPaymentRepo $detPaymentRepo,PaymentRepo $paymentRepo)
    {
        $this->detPaymentRepo = $detPaymentRepo;
        $this->paymentRepo=$paymentRepo;
        $this->detCashRepo=$detCashRepo;
        $this->cashRepo=$cashRepo;
        $this->cashMonthlyRepo=$cashMonthlyRepo;
        $this->yearRepo=$yearRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
    }

    public function paginatep(){
        $persons = $this->detPaymentRepo->paginate(5);
        return response()->json($persons);
    }
    public function create(Request $request)
    {
      \DB::beginTransaction();
       // var_dump($request->all());die();;
        $var=$request->detPayments;
        //var_dump($var);die();
        $detPayment = $this->detPaymentRepo->getModel();
        $cashMonthly=$this->cashMonthlyRepo->getModel();
        $detCash=$this->detCashRepo->getModel();
        //var_dump($request->input('id'));
        $cash =$this->cashRepo->find($request->cash_id);
        $payment = $this->paymentRepo->find($request->id);
        $update = new PaymentManager($payment,$request->only("Acuenta","Saldo"));
        $update->save();
        $var['tipoPago']='P';
        $verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
        /*if($request->input("methodPayment_id")==4){
              $request->merge(['Saldo'=>$verDeudas->Saldo-$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$verDeudas->orderPurchase_id]);
              $request->merge(['supplier_id'=>$verDeudas->supplier_id]);
              $updateSaldoF=new pendientAccountManager($verDeudas,$request->all());
              $updateSaldoF->save();
        }*/
        
     if(intval($request->input('cash_id'))>0){
        //var_dump("hola");die();
        $detcash = new DetCashManager($detCash,$request->all());
        $detcash->save();
        $var['detCash_id']=$detCash->id;
             $request->merge(["gastos"=>floatval($cash->gastos)+floatval($var["montoPagado"])]);
             $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>$cash->ingresos]);
             $request->merge(['montoBruto'=>floatval($cash->montoBruto)-floatval($var["montoPagado"])]);
             $request->merge(['montoReal'=>$cash->montoReal]);
             $request->merge(['descuadre'=>$cash->descuadre]);
             $request->merge(['estado'=>$cash->estado]);
             $request->merge(['notas'=>$cash->notas]);
             $request->merge(['cashHeader_id'=>$cash->cashHeader_id]);
             if($cash->user_id==auth()->user()->id  && $cash->estado==1){
                   $request->merge(['user_id'=>$cash->user_id]);
             }else{
                 return response()->json(['estado'=>'Usted no tiene permisos sobre esta caja o la caja esta cerrada??']);
             }
        $cashr = new CashManager($cash,$request->all());
        $cashr->save();
    }
    if($request->input('cajamensual')==true){
        
   // $año=$this->yearRepo->findID($request->input("año"));
    //var_dump($request->input("año"));
    //$request->merge(["years_id"=>$año['id']]);
    $request->merge(["amount"=>$var["montoPagado"]]);
    $request->merge(['descripcion'=>"Pago a Proveedores"]);
    $request->merge(['expenseMonthlys_id'=>1]);
    //var_dump($request->detPayments["fecha"]);die();
    $request->merge(['fecha'=>$request->detPayments["fecha"]]);
    $cashMontl = new CashMonthlyManager($cashMonthly,$request->all());
    $cashMontl->save();
    $var['cashMonthly_id']=$cashMonthly->id;
}
    $manager = new DetPaymentManager($detPayment,$var);
    $manager->save();
    $idpago=$detPayment->id;
       /* if($this->detPaymentRepo->validateDate(substr($request->exedetPayments['fecha'],0,10))){
            $request->detPayments['fecha'] = substr($request->detPayments['fecha'],0,10);
        }else{
           
            $request->detPayments['fecha'] = null;
        }*/
       // $detPayment->save();
        \DB::commit();
        return response()->json(['estado'=>true,'id'=>$idpago,'montoP'=>$detPayment->Acuenta]);
    }

    public function find($id)
    {
        $detPayment = $this->detPaymentRepo->mostrarDetPayment($id);
        return response()->json($detPayment);
    }

    public function edit(Request $request)
    {
      var_dump("hola");die();
        $detPayment = $this->detPaymentRepo->find($request->id);
        $manager = new DetPaymentManager($detPayment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detPayment->nombre]);
    }
    public function ReportComprobante($id){
     //var_dump("hola commd".$tipo.$fechaini.$fechafin);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_Comprobante';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/Comprobante.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idPago'=>$id],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_Comprobante.'.$ext;
   
    }
}