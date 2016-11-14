<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager;
use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;
use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;
use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class DetailOrderPurchasesController extends Controller {

    protected $detailOrderPurchaseRepo;
    protected $orderPurchaseRepo;

    public function __construct(StockRepo $stockRepo,PaymentRepo $paymentRepo,DetPaymentRepo $detPaymentRepo,PendientAccountRepo $pendientAccountRepo,DetailOrderPurchaseRepo $detailOrderPurchaseRepo, OrderPurchaseRepo $orderPurchaseRepo)
    {
        $this->detailOrderPurchaseRepo = $detailOrderPurchaseRepo;
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
        $this->paymentRepo = $paymentRepo;
        $this->detPaymentRepo = $detPaymentRepo;
        $this->stockRepo=$stockRepo;
    }


    public function index()
    {
        return View('detailPurchase.index');
        //return 'hola';
    }

    public function all($estado)
    {
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->paginaporEstados($estado);
        return response()->json($detailOrderPurchases);
        //var_dump($materials);
    }

    public function paginatep($id){
        $detailOrderPurchases =$this->detailOrderPurchaseRepo->paginate($id);
        return response()->json($detailOrderPurchases);
    }


    public function form_create()
    {
        return View('detailOrderPurchases.form_create');
    }

    public function form_edit()
    {
        return View('detailOrderPurchases.form_edit');
    }

    public function create(Request $request)
    {
  //-----------------------------------------------------
 /* $var =$request->detailOrderPurchases;
  $montotot=$request->input('MontoTotal');
  //$verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
  //var_dump($request->input('id'));die();
  $detailOrderPurchaseRepox;
         
       foreach($var as $object){

           $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
           $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
           $insertar->save();
           $detailOrderPurchaseRepox = null;

       }
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
              $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$verDeudas->Saldo]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=$request->input('MontoTotal')-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }*/
          /* if($verDeudas->Saldo>0 && $SaldoAfavor<=$verDeudas->Saldo){
              $var=$request->detPayments; 
              if($provicional==null){
              $payment = $this->paymentRepo->getModel();
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->find($provicional);
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
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
              //$request->merge(['methodPayment_id'=>4]);
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
              if($provicional==null){
              $payment = $this->paymentRepo->getModel();
              //$request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=> $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->fine($provicional);
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+ $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
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
      return response()->json(['estado'=>true]);
    }*/}
    public function destroy(Request $request)
    {
      
           $detailOrderPurchases= $this->detailOrderPurchaseRepo->find($request->id);
        $detailOrderPurchases->delete();
       
      return response()->json(['estado'=>true]);
        
    }
    public function Eliminar($id){
         $detailOrderPurchases = $this->detailOrderPurchaseRepo->Eliminar($id);
        return response()->json($detailOrderPurchases);
    }

    public function find($id)
    {
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->find($id);
        return response()->json($detailOrderPurchases);
    }

    public function edit(Request $request)
    {
    \DB::beginTransaction();
      //var_dump($request->all());die();
       $var=$request->detailOrderPurchases;//->except($request->detailOrderPurchases["id"]);
       $orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
       $orderPurchase = $this->orderPurchaseRepo->find($request->id);
       $almacen_id=$request->input("warehouses_id");
       
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
  
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();
       $orderPurchase->detPres()->detach();
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
                  if(!empty($object["nuevo"])){
                      $object["porLlegar"]=$stockac->porLlegar+$object["cantidad"];
                   }else{
                      if(!empty($object["cantAnterior"])){
                        $object["porLlegar"]=(floatval($stockac->porLlegar)-floatval($object["cantAnterior"]))+floatval($object["cantidad"]);
                      }else{
                        $object["porLlegar"]=$stockac->porLlegar;
                      }
                   }
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

       }
       $payment = $this->paymentRepo->getModel();
        $payment1 = $this->paymentRepo->paymentById($request->input('id'));
        
        if(!empty($payment1)){
          
          $request->merge(['Acuenta'=>$payment1->Acuenta]);
        $request->merge(['orderPurchase_id'=>$request->input('id')]);
        $salc=floatval($request->input('montoTotal'))-floatval($request->input('Acuenta'));
        $request->merge(['Saldo'=>$salc]);  
           $manager = new PaymentManager($payment1,$request->all());
           $manager->save(); 
           $provicional=$request->idpayment;
        }
       \DB::commit(); 
      return response()->json(['estado'=>true]);
    }

    

    public function search($q)
    {
        //$q = Input::get('q');
        $detailOrderPurchases = $this->detailOrderPurchaseRepo->search($q);

        return response()->json($detailOrderPurchases);
    }
}