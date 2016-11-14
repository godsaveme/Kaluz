<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;
use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\CashMonthlyRepo;
use Salesfly\Salesfly\Managers\CashMonthlyManager;

use Salesfly\Salesfly\Repositories\YearRepo;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;
class PaymentsController extends Controller {

    protected $paymentRepo;

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


    public function create(Request $request)
    {
        \DB::beginTransaction();
       // var_dump($request->all());die();
        //var_dump($request->all());die();
       /* $var=$request->detPayments;
      // var_dump($var);die();
        $payment = $this->paymentRepo->getModel();
        $detPayment = $this->detPaymentRepo->getModel();
        $provicional;
        if($request->idpayment==null){
        $manager = new PaymentManager($payment,$request->all());
        $manager->save();
        $provicional=$payment->id;
        }else{
            $payment1 = $this->paymentRepo->find($request->idpayment);
           $manager = new PaymentManager($payment1,$request->all());
           $manager->save(); 
           $provicional=$request->idpayment;
        }
        $var['tipoPago']='A';
        $var['payment_id']=$provicional;
        $insertDetP = new DetPaymentManager($detPayment,$var);
        $insertDetP->save();*/
        //****************************************
          $var=$request->detPayments;
      // var_dump($request->all());die();
        $payment = $this->paymentRepo->getModel();
        $detPayment = $this->detPaymentRepo->getModel();
        $cashMonthly=$this->cashMonthlyRepo->getModel();
        $detCash=$this->detCashRepo->getModel();
        $cash =$this->cashRepo->find($request->cash_id);
        //var_dump($request->input('id'));
        $provicional;
        if($request->idpayment==null){
        //var_dump("hhola si soy nuevo");
        //var_dump($request->all());
        //die();
        $manager = new PaymentManager($payment,$request->except("purchase_id"));
        $manager->save();
        $provicional=$payment->id;
        }else{
            $payment1 = $this->paymentRepo->find($request->idpayment);
           $manager = new PaymentManager($payment1,$request->only("Acuenta","Saldo"));
           $manager->save(); 
           $provicional=$request->idpayment;
        }
        $var['tipoPago']='A';
        $var['payment_id']=$provicional;

       /* $detcash = new DetCashManager($detCash,$request->all());
        $detcash->save();
        $var['detCash_id']=$detCash->id;
        $manager = new DetPaymentManager($detPayment,$var);
        $manager->save();
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
        $cashr = new CashManager($cash,$request->all());
        $cashr->save();*/
//*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
             $var["methodPayment_id"]=null;
        $cashr = new CashManager($cash,$request->all());
        $cashr->save();
    }
    if($request->input('cajamensual')==true){
    $request->merge(['fecha'=>$var["fecha"]]); 
    //$año=$this->yearRepo->findID($request->input("año"));
    //var_dump($año["id"]);die();
    //$request->merge(["years_id"=>$año->id]);
    $request->merge(["amount"=>$var["montoPagado"]]);
    $request->merge(['descripcion'=>"Pago a Proveedores"]);
    $request->merge(['expenseMonthlys_id'=>1]);
    $cashMontl = new CashMonthlyManager($cashMonthly,$request->all());
    $cashMontl->save();
    $var['cashMonthly_id']=$cashMonthly->id;
    $var["methodPayment_id"]=null;
}
    $manager = new DetPaymentManager($detPayment,$var);
    $manager->save();
    $idetdPayment=$detPayment->id;
    \DB::commit();

        return response()->json(['estado'=>true,'id'=>$idetdPayment, 'nombre'=>$payment->id]);
    }

    public function find($id)
    {
        $payment = $this->paymentRepo->paymentById($id);
        return response()->json($payment);
    }

    public function edit(Request $request)
    {
        \DB::beginTransaction();
        $var=$request->detPayments;
        $detPayment= $this->detPaymentRepo->find($request->detpId);
         $pagoTemporal=$detPayment->montoPagado;
        $detpay = new DetPaymentManager($detPayment,$var);
        $detpay->save();
       
       
        $payment = $this->paymentRepo->find($request->id);
        $manager = new PaymentManager($payment,$request->only("Acuenta","Saldo"));
        $manager->save();
        //=======================================================
        //var_dump($request->input('Saldo_F'));die();
        if(intval($request->input('Saldo_F'))>0){
                    //var_dump($request->input("fecha"));die();
                     $SaldosTemporales =$this->pendientAccountRepo->find2($detPayment['Saldo_F']);
                     if($SaldosTemporales!=null){
                      //  var_dump($SaldosTemporales->Saldo);die();
                     $request->merge(['Saldo'=>floatval($SaldosTemporales->Saldo)+floatval($pagoTemporal)]);
                     $request->merge(['Saldo'=>floatval($request->input('Saldo'))-floatval($detPayment['montoPagado'])]);
                     //var_dump($request->input("Saldo"));die();
                     $request->merge(['orderPurchase_id'=>$SaldosTemporales->orderPurchase_id]);
                      $request->merge(['supplier_id'=>$SaldosTemporales->supplier_id]);
                     $request->merge(['estado'=>0]);
                     $request->merge(["fecha"=>$SaldosTemporales->fecha]);
                     $insercount=new PendientAccountManager($SaldosTemporales,$request->all());
                     $insercount->save();
                    }
                 
        }
       
        
      //=====================================================================
        
        //$provicional;
 if(intval($request->input('detCash_id'))>0){
      $detCash=$this->detCashRepo->find($request->input('detCash_id'));
        $cash =$this->cashRepo->find($detCash["cash_id"]);
        $request->merge(['montoCaja'=>floatval($cash->montoBruto)+floatval($pagoTemporal)]);
        //var_dump(floatval($request->input('montoCaja')));
        $request->merge(['montoMovimientoEfectivo'=>floatval($var["montoPagado"])]);
        $totalCajaACtual=$request->input('montoMovimientoEfectivo');
        //var_dump(floatval($totalCajaACtual));
        //$request->merge(['montoMovimientoEfectivo'=>floatval($totalCajaACtual)+floatval($var['montoPagado'])]);
        //$totalCajaACtual=$request->input('montoMovimientoEfectivo');
        //var_dump(floatval($totalCajaACtual));die();
        //$request->merge(["montoBruto"=>floatval($request->input('montoCaja')-floatval($pagoTemporal)])
        $request->merge(['montoFinal'=>floatval($request->input('montoCaja'))-floatval($totalCajaACtual)]);
        $request->merge(['montoBruto'=>floatval($request->input("montoFinal"))]);
       // var_dump(floatval($request->input('montoBruto')));die();
        $request->merge(["gastos"=>floatval($cash->gastos)-floatval($pagoTemporal)]);
        $request->merge(["gastos"=>floatval($request->input("gastos")+floatval($var["montoPagado"]))]);
       // var_dump($request->all());
             $request->merge(['fecha'=>$detCash->fecha]);
             $request->merge(['montoMovimientoTarjeta'=>0]);
             $request->merge(['hora'=>$detCash->hora]);
             $request->merge(['estado'=>1]);
             $request->merge(['cashMotive_id'=>$detCash->cashMotive_id]);
          //   var_dump($request->all());die();
        $detcash = new DetCashManager($detCash,$request->all());
        $detcash->save();
            $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>$cash->ingresos]);
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
if(intval($request->input('cashMonthly_id'))>0){
        
    $cashMontly=$this->cashMonthlyRepo->find($request->input("cashMonthly_id"));
    //var_dump($año["id"]);die();
    $request->merge(["years_id"=>$cashMontly->years_id]);
    $request->merge(["amount"=>$var["montoPagado"]]);
    $request->merge(['descripcion'=>"Pago a Proveedores"]);
    $request->merge(['expenseMonthlys_id'=>1]);
    $request->merge(['fecha'=>$var["fecha"]]);
    $request->merge(['months_id'=>$cashMontly->months_id]);

    $cashMontl = new CashMonthlyManager($cashMontly,$request->all());
    $cashMontl->save();
    //$var['cashMonthly_id']=$cashMonthly->id;
}
\DB::commit();
        //==============================
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]); 
    }
  public function destroy(Request $request)
    {
        \DB::beginTransaction();
        //var_dump($request->all());die();
        $detPayment=$this->detPaymentRepo->find($request->detpId);
        $pagoTemporal=$detPayment->montoPagado;
        $detPayment->delete();
        $MontotalTemp=$request->input('MontoTotal');
        $AcuentaTemp=$request->input('Acuenta');
        
        $request->merge(['Acuenta'=>$AcuentaTemp-$pagoTemporal]);
        $AcuentaTemp2=$request->input('Acuenta');
        $request->merge(['Saldo'=>$MontotalTemp-$AcuentaTemp2]);
        //var_dump($request->all());die();
        $payment = $this->paymentRepo->find($request->id);
        $manager = new PaymentManager($payment,$request->only("Acuenta","Saldo"));
        $manager->save();
        if(intval($request->input('Saldo_F'))>0){
                    //var_dump($request->input("fecha"));die();
                     $SaldosTemporales =$this->pendientAccountRepo->find2($request->input('Saldo_F'));
                     if($SaldosTemporales!=null){
                      //  var_dump($SaldosTemporales->Saldo);die();
                     $request->merge(['Saldo'=>floatval($SaldosTemporales->Saldo)+floatval($pagoTemporal)]);
                     //$request->merge(['Saldo'=>floatval($request->input('Saldo'))-floatval($detPayment['montoPagado'])]);
                     //var_dump($request->input("Saldo"));die();
                     $request->merge(['orderPurchase_id'=>$SaldosTemporales->orderPurchase_id]);
                      $request->merge(['supplier_id'=>$SaldosTemporales->supplier_id]);
                     $request->merge(['estado'=>0]);
                     $request->merge(["fecha"=>$SaldosTemporales->fecha]);
                     $insercount=new PendientAccountManager($SaldosTemporales,$request->all());
                     $insercount->save();
                    }
                 
        }
        // var_dump($request->input("detCash_id"));die();
        if(intval($request->input('detCash_id'))==true){
            
            $detcash=$this->detCashRepo->find($request->input("detCash_id"));
            //var_dump($detcash->cash_id);
            $cash=$this->cashRepo->find($detcash->cash_id);
            //var_dump($cash['id']);die();
            
             $request->merge(["gastos"=>floatval($cash->gastos)-floatval($pagoTemporal)]);
             $request->merge(['montoBruto'=>floatval($cash->montoBruto)+floatval($pagoTemporal)]);
             $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>$cash->ingresos]);
             //$request->merge(['montoBruto'=>$cash->montoBruto]);
             $request->merge(['montoReal'=>$cash->montoReal]);
             $request->merge(['descuadre'=>$cash->descuadre]);
             $request->merge(['estado'=>$cash->estado]);
             $request->merge(['notas'=>$cash->notas]);
             $request->merge(['cashHeader_id'=>$cash->cashHeader_id]);
            $cashr = new CashManager($cash,$request->all());
            $cashr->save();
            $detcash->delete();
        }
        if(intval($request->input("cashMonthly_id"))>0){
             $cashMontl =$this->cashMonthlyRepo->find($request->input("cashMonthly_id"));
             $cashMontl->delete();
        }
       \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
    public function payIDLocal($id){
        $payment = $this->paymentRepo->payIDLocal($id);
        return response()->json($payment);
    }
}