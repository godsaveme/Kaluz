<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SalePaymentRepo;
use Salesfly\Salesfly\Managers\SalePaymentManager;

use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\SaleDetPaymentManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

class SalePaymentController extends Controller {

    protected $salePaymentRepo;

    public function __construct(SalePaymentRepo $salePaymentRepo,SaleDetPaymentRepo $saleDetPaymentRepo,DetCashRepo $detCashRepo,cashRepo $cashRepo)
    {
        $this->salePaymentRepo = $salePaymentRepo;
        $this->saleDetPaymentRepo = $saleDetPaymentRepo;
        $this->detCashRepo=$detCashRepo;
        $this->cashRepo=$cashRepo;
    }

    public function searchPayment($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPayment($id);

        return response()->json($detOrder);
    }
    public function searchPaymentOrder($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPaymentOrder($id);

        return response()->json($detOrder);
    }
    public function searchPaymentSeparate($id)
    {
        //$q = Input::get('q');
        $detOrder = $this->salePaymentRepo->searchPaymentSeparate($id);

        return response()->json($detOrder);
    }
    public function edit(Request $request)
    {
        //var_dump($request->all());die();
        $payment = $this->salePaymentRepo->find($request->id);
        $manager = new SalePaymentManager($payment,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
    public function editdetpatmentSale(Request $request)
    {
        $payment=$this->saleDetPaymentRepo->find($request->id);
        $diferenciaPago=($payment->monto)-($request->monto);

        $manager = new SaleDetPaymentManager($payment,$request->all());
        $manager->save();
        //-----------------------------------------------
        $cash = $this->cashRepo->find($request->numCaja);

        $cash['montoBruto']=$cash['montoBruto']-$diferenciaPago;
        $cash['ingresos']=$cash['ingresos']-$diferenciaPago;
        //var_dump($cash);die();
        $cash->save();
        //-----------------------------------------------
        //-----------------------------------------------
        $detcash = $this->detCashRepo->find($request->detCash_id);
        if ($request->saleMethodPayment_id=='1') {
            $detcash['montoMovimientoEfectivo']=$request->monto;
            $detcash['montoMovimientoTarjeta']=0;
        }else{
            $detcash['montoMovimientoEfectivo']=0;
            $detcash['montoMovimientoTarjeta']=$request->monto;  
        }
        $detcash->save();
        //var_dump($cash);die();
        $cash->save();
        //-----------------------------------------------
        $deetpayment = $this->salePaymentRepo->find($request->salePayment_id);

        $deetpayment['Acuenta']=$deetpayment['Acuenta']-$diferenciaPago;
        $deetpayment['Saldo']=$deetpayment['Saldo']+$diferenciaPago;
        
        $deetpayment->save();

        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);

    }
    public function destroy(Request $request) 
    {
        //var_dump($request->all());die();
        $detPayment=$this->saleDetPaymentRepo->find($request->detpayment_id);

        $pagoTemporal=$detPayment->monto;
        $detPayment->delete();

        $MontotalTemp=$request->input('MontoTotal');
        $AcuentaTemp=$request->input('Acuenta');
        
        $request->merge(['Acuenta'=>$AcuentaTemp-$pagoTemporal]);
        $AcuentaTemp2=$request->input('Acuenta');
        $request->merge(['Saldo'=>$MontotalTemp-$AcuentaTemp2]);

        $payment = $this->salePaymentRepo->find($request->id);

        $manager = new SalePaymentManager($payment,$request->only("Acuenta","Saldo"));
        $manager->save();

        if(intval($request->input('detCash_id'))==true){
            
            $detcash=$this->detCashRepo->find($request->input("detCash_id"));
            $cash=$this->cashRepo->find($detcash->cash_id);

            if($detcash->montoMovimientoTarjeta > 0 && $detcash->montoMovimientoEfectivo>0){
                if ($request->saleMethodPayment==1) {
                    $detcash->montoMovimientoEfectivo=0;
                }else{
                    $detcash->montoMovimientoTarjeta=0;
                }
                //$detcashedit=$this->detCashRepo->find($request->input("detCash_id"));

                //$manager1 = new DetCashManager($detcashedit,$request->$detcash);
                $detcash->save();
            }else{
                $detcash->delete();   
            }
            
             $request->merge(["gastos"=>$cash->gastos]);
             $request->merge(['montoBruto'=>floatval($cash->montoBruto)-floatval($pagoTemporal)]);
             $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>floatval($cash->ingresos)-floatval($pagoTemporal)]);
             //$request->merge(['montoBruto'=>$cash->montoBruto]);
             $request->merge(['montoReal'=>$cash->montoReal]);
             $request->merge(['descuadre'=>$cash->descuadre]);
             $request->merge(['estado'=>$cash->estado]);
             $request->merge(['notas'=>$cash->notas]);
             $request->merge(['cashHeader_id'=>$cash->cashHeader_id]); 
            $cashr = new CashManager($cash,$request->all());
            $cashr->save();
            
        }
       
        return response()->json(['estado'=>true, 'nombre'=>$payment->nombre]);
    }
}