<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;
use Salesfly\Salesfly\Managers\SalePaymentManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\SaleRepo;
use Salesfly\Salesfly\Managers\SaleManager;

use Salesfly\Salesfly\Repositories\SeparateSaleRepo;
use Salesfly\Salesfly\Managers\SeparateSaleManager;

use Salesfly\Salesfly\Repositories\OrderSaleRepo;
use Salesfly\Salesfly\Managers\OrderSaleManager;

class SaleDetPaymentController extends Controller {

    protected $saleDetPaymentRepo;
    //protected $salePaymentRepo;

    public function __construct(SaleDetPaymentRepo $saleDetPaymentRepo)
    {
        $this->saleDetPaymentRepo = $saleDetPaymentRepo;
        //$this->salePaymentRepo = $salePaymentRepo;
    }



    public function paginatep(){
        $persons = $this->saleDetPaymentRepo->paginate(5);
        return response()->json($persons);
    }
    

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $saleDetPayment = $this->saleDetPaymentRepo->searchDetalle($id);

        return response()->json($saleDetPayment);
    }

    //------------------------------------------------------
    public function create(Request $request)
    {
        //var_dump($request->all());die();
        \DB::beginTransaction();
        $saldo=$request->input("Saldo");
        if ($request->input("tipo")=='order') {
            
            $var1=$request->sale;
            

            $saleTemporal=$var1["id"];

            $salerepo;

            $salerepo = new OrderSaleRepo;
            $saleSave=$salerepo->getModel();

            $saleEdit = $saleSave->find($saleTemporal);
            //var_dump($saleEdit);die();
            if($saldo=='0'){$var1['estado']='0';}
            $manager = new OrderSaleManager($saleEdit,$var1);
            $manager->save();

            $temporal=$request->input("orderSale_id");
            }else if ($request->input("tipo")=='sale') {
                $var2=$request->sale;
                
                $saleTemporal1=$var2["id"];
    
                $order;
    
                $order = new  SaleRepo;
                $orderSave=$order->getModel();
    
                $orderEdit = $orderSave->find($saleTemporal1);
                //var_dump($orderEdit);die();
                if($saldo=='0'){$var2['estado']='1';}
                $manager = new SaleManager($orderEdit,$var2);
                $manager->save();   

                $temporal=$request->input("sale_id");
            }else if ($request->input("tipo")=='separate') {
                $var3=$request->sale; //separate sales se refiere
                
                $saleTemporal2=$var3["id"];
    
                $separate;
    
                $separate = new  SeparateSaleRepo;
                $separateSave=$separate->getModel();
    
                $orderEdit = $separateSave->find($saleTemporal2);
                //var_dump($var2);die();
                if($saldo=='0'){$var3['estado']='1';} //1->terminado
                $manager = new SeparateSaleManager($orderEdit,$var3);
                $manager->save();   

                $temporal=$request->input("separateSale_id");
            }
        
        //---create movimiento---
            $movimiento = $request->movimiento;
            $detCashrepo;
            $movimiento['observacion']=$temporal;
            $detCashrepo = new DetCashRepo;
            $movimientoSave=$detCashrepo->getModel();

            if($var3['tipo'] == 2) $movimiento['cashMotive_id'] = 17; //si el tipo es 2(pedido) , el cashmotive_id es 17 (pago credito pedido)
        
            $insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            $insertarMovimiento->save();
            
            $detCash_id=$movimientoSave->id;
    //---Autualizar Caja---   
            $cajaAct = $request->caja;
            $temporal2=$cajaAct['id'];
            $cashrepo;
            $cashrepo = new CashRepo;
            $cajaSave=$cashrepo->getModel();
            $cash1 = $cashrepo->find($cajaAct["id"]);
            $manager1 = new CashManager($cash1,$cajaAct);
            $manager1->save();
        //----------------
        
        $var=$request->detPayments;
        
        $temporal=$var["salePayment_id"];

        $salePaymentrepo;

        $salePaymentrepo = new SalePaymentRepo;
        $paymentSave=$salePaymentrepo->getModel();

        $payment1 = $paymentSave->find($temporal);
        //if($saldo=='0'){$request->input("estado")='0';}
        $manager = new SalePaymentManager($payment1,$request->except('id'));
        $manager->save();

        //------------------------------------
        //var_dump($grabar);die();
        

        //------------------------------------


        $detPayment = $this->saleDetPaymentRepo->getModel();
        $detPayment['numCaja']=$temporal2;

        $grabar=$request->detPayments;
        $detPayment['detCash_id']=$detCash_id;
        $manager = new SaleDetPaymentManager($detPayment,$grabar);
        $manager->save();
       /* if($this->detPaymentRepo->validateDate(substr($request->exedetPayments['fecha'],0,10))){
            $request->detPayments['fecha'] = substr($request->detPayments['fecha'],0,10);
        }else{
           
            $request->detPayments['fecha'] = null;
        }*/
       // $detPayment->save();
        \DB::commit();
        return response()->json(['estado'=>true, 'montoP'=>$detPayment->Acuenta]);
    }
    public function find($id)
    {
        $detPayment = $this->saleDetPaymentRepo->mostrarDetPayment($id);
        return response()->json($detPayment);
    }

    public function edit(Request $request)
    {
        $detPayment = $this->detPaymentRepo->find($request->id);
        $manager = new DetPaymentManager($detPayment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$detPayment->nombre]);
    }
//------------------------------------------------------
}