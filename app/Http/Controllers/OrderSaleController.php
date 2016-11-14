<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderSaleRepo;
use Salesfly\Salesfly\Managers\OrderSaleManager;

use Salesfly\Salesfly\Repositories\DetOrderSaleRepo;
use Salesfly\Salesfly\Managers\DetOrderSaleManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Managers\SalePaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;

use Salesfly\Salesfly\Managers\DetCashManager;
use Salesfly\Salesfly\Repositories\DetCashRepo;

use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\StockRepo;

class OrderSaleController extends Controller {

    protected $orderSaleRepo;

    public function __construct(OrderSaleRepo $orderSaleRepo)
    {
        $this->orderSaleRepo = $orderSaleRepo;
    }

    public function index() 
    {
        return View('orderSales.index');
    }

    public function all()
    {
        $orderSales = $this->orderSaleRepo->paginate(15);
        return response()->json($orderSales);
        //var_dump($orderSales);
    }

    public function paginatep(){
        $orderSales = $this->orderSaleRepo->paginate(15);
        return response()->json($orderSales);
    }


    public function form_create()
    {
        return View('orderSales.form_create');
    }

    public function form_edit()
    {
        return View('orderSales.form_edit');
    }
public function create(Request $request) {
        $orderSale = $this->orderSaleRepo->getModel();
        $var = $request->detOrders;
        $payment = $request->salePayment;
        $saledetPayments = $request->saledetPayments;
        
        $manager = new OrderSaleManager($orderSale,$request->all());
        $manager->save();
        /*
       if($this->purchaseRepo->validateDate(substr($request->input('fechaEntrega'),0,10))){
            $order->fechaEntrega = substr($request->input('fechaEntrega'),0,10);
        }else{
           
            $order->fechaEntrega = null;
        }*/ 
        $orderSale->save();

        $temporal=$orderSale->id; 

        //---create movimiento---
            $movimiento = $request->movimiento;
            $detCashrepo;
            $movimiento['observacion']=$temporal;
            $detCashrepo = new DetCashRepo;
            $movimientoSave=$detCashrepo->getModel();
        
            $insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            $insertarMovimiento->save();
            $detCash_id=$movimientoSave->id;
    //---Autualizar Caja---
            
            $cajaAct = $request->caja;
            $cashrepo;
            $cashrepo = new CashRepo;
            $cajaSave=$cashrepo->getModel();
            $cash1 = $cashrepo->find($cajaAct["id"]);

            $manager1 = new CashManager($cash1,$cajaAct);
            $manager1->save();
            

        //----------------
        $salePaymentrepo;
        $payment['orderSale_id']=$temporal;
        $salePaymentrepo = new SalePaymentRepo;
        $paymentSave=$salePaymentrepo->getModel();
        
        $insertarpayment=new SalePaymentManager($paymentSave,$payment);
        $insertarpayment->save();          
        $paymentSave->save();

        $temporal1=$paymentSave->id;
            //--------------------------
                $saledetPaymentrepo;
                foreach($saledetPayments as $object1){
                    $object1['salePayment_id'] = $temporal1;
                    $object1['detCash_id']=$detCash_id;

                    $saledetPaymentrepo = new SaleDetPaymentRepo;

                    $insertar=new SaleDetPaymentManager($saledetPaymentrepo->getModel(),$object1);
                    $insertar->save();
          
                    $saledetPaymentrepo = null;
                }

        $detOrderrepox;
         
       foreach($var as $object){
           $object['orderSale_id'] = $temporal;


           $detOrderrepox = new DetOrderSaleRepo;

           $insertar=new DetOrderSaleManager($detOrderrepox->getModel(),$object);
           $insertar->save();
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockPedidos"]=$stockac->stockPedidos+($object["cantidad"]);//
                  
                }else{
                  $object["stockPedidos"]=$stockac->stockPedidos+($object["cantidad"]*$object["equivalencia"]);
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
    }

    public function find($id)
    {
        $material = $this->orderSaleRepo->find($id);
        return response()->json($material);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $orderSales = $this->orderSaleRepo->search($q);

        return response()->json($orderSales);
    } 
    public function edit(Request $request)
    {
        $varDetOrders = $request->detOrder;
        $varPayment = $request->payment;
        $movimiento = $request->movimiento;
        if ($movimiento['montoMovimientoEfectivo']>0) {
            //---create movimiento--- 
            //var_dump($request->movimiento);die();
            $detCashrepo;
            $movimiento['observacion']="temporal";
            $detCashrepo = new DetCashRepo;
            $movimientoSave=$detCashrepo->getModel();
        
            $insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            $insertarMovimiento->save();
    //---Autualizar Caja---
            
            $cajaAct = $request->caja;
            $cashrepo;
            $cashrepo = new CashRepo;
            $cajaSave=$cashrepo->getModel();
            $cash1 = $cashrepo->find($cajaAct["id"]);

            $manager1 = new CashManager($cash1,$cajaAct);
            $manager1->save();
        //----------------

            $salePaymentRepo;
        $salePaymentRepo = new SalePaymentRepo;
        $payment = $salePaymentRepo->find($varPayment['id']);
        $manager = new SalePaymentManager($payment,$varPayment);
        $manager->save();

        }
        
        $detOrderSaleRepo;
        foreach($varDetOrders as $object){
            $detOrderSaleRepo = new DetOrderSaleRepo;

            $detorderSale = $detOrderSaleRepo->find($object['id']);
            $manager = new DetOrderSaleManager($detorderSale,$object);
            $manager->save();

            $stokRepo;
            $stokRepo = new StockRepo;
            $cajaSave=$stokRepo->getModel();
            $stockOri = $stokRepo->find($object['id']);

            $stock = $stokRepo->find($object['idStock']);
            if ($object['estad']==true) {
                $stock->stockPedidos= $stock->stockPedidos-$object['canPendiente'];
            }else{
                $stock->stockPedidos= $stock->stockPedidos+$object['canPendiente'];
            }

            $stock->save();
        }

        $orderSale = $this->orderSaleRepo->find($request->id);
        $manager = new OrderSaleManager($orderSale,$request->all());
        $manager->save();

        



        return response()->json(['estado'=>true, 'nombre'=>$orderSale->nombre]);
    }
}