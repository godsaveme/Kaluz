<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SeparateSaleRepo;
use Salesfly\Salesfly\Managers\SeparateSaleManager;

use Salesfly\Salesfly\Repositories\DetSeparateSaleRepo;
use Salesfly\Salesfly\Managers\DetSeparateSaleManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Managers\HeadInputStockManager;
use Salesfly\Salesfly\Repositories\HeadInputStockRepo;

use Salesfly\Salesfly\Managers\InputStockManager;
use Salesfly\Salesfly\Repositories\InputStockRepo;

use Salesfly\Salesfly\Managers\SalePaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;

use Salesfly\Salesfly\Managers\DetCashManager;
use Salesfly\Salesfly\Repositories\DetCashRepo;

use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\StockRepo;

class SeparateSaleController extends Controller {

    protected $separateSaleRepo;

    public function __construct(SeparateSaleRepo $separateSaleRepo)
    {
        $this->separateSaleRepo = $separateSaleRepo;
    }

    public function index() 
    {
        return View('separateSales.index');
    }

    public function all()
    {
        $separateSales = $this->separateSaleRepo->paginate(15);
        return response()->json($separateSales);
        //var_dump($separateSales);
    }

    public function paginatep(){
        $separateSales = $this->separateSaleRepo->paginate(15);
        return response()->json($separateSales);
    }


    public function form_create()
    {
        return View('separateSales.form_create');
    }

    public function form_edit()
    {
        return View('separateSales.form_edit');
    }
public function create(Request $request) {


    //var_dump($request->all());die();//tipo

    $tipo = $request->input('tipo');

    \DB::beginTransaction();

        $orderSale = $this->separateSaleRepo->getModel();
        $var = $request->detOrders;
        $payment = $request->salePayment;
        $saledetPayments = $request->saledetPayments;

        $request->merge(['fechaPedido' => date('Y-m-d H:i:s')]);
        if($payment['Saldo'] == 0){
            $request->merge(['estado' => 1]);
        }else {
            $request->merge(['estado' => 0]);
        }
        $manager = new SeparateSaleManager($orderSale,$request->all());
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

            $movimiento['fecha'] = date('Y-m-d');
            $movimiento['hora'] = date('H:i:s');

            if($tipo == 2) $movimiento['cashMotive_id'] = 16;
        
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
        $payment['separateSale_id']=$temporal;
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

                    $object1['fecha']=date('Y-m-d H:i:s');

                    $saledetPaymentrepo = new SaleDetPaymentRepo;

                    $insertar=new SaleDetPaymentManager($saledetPaymentrepo->getModel(),$object1);
                    $insertar->save();
          
                    $saledetPaymentrepo = null;
                }

        $detOrderrepox;
         
       foreach($var as $object){
           $object['separateSale_id'] = $temporal;

           $detOrderrepox = new DetSeparateSaleRepo;

           $insertar=new DetSeparateSaleManager($detOrderrepox->getModel(),$object);
           $insertar->save();
          
           $detOrderrepox = null; 

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
            if(!empty($stockac)){

                if($tipo == 2){ //PEDIDOS
                    if($object["equivalencia"]==null){
                        $object["stockPedidos"]=$stockac->stockPedidos+($object["cantidad"]);//

                    }else{
                        $object["stockPedidos"]=$stockac->stockPedidos+($object["cantidad"]*$object["equivalencia"]);
                    }
                }elseif($tipo == 1){ //SEPARADOS
                    if($object["equivalencia"]==null){
                        $object["stockSeparados"]=$stockac->stockSeparados+($object["cantidad"]);//

                    }else{
                        $object["stockSeparados"]=$stockac->stockSeparados+($object["cantidad"]*$object["equivalencia"]);
                    }
                }
             

                  $manager = new StockManager($stockac,$object);
                  $manager->save();
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }

    \DB::commit();

     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
    }

    public function find($id)
    {
        $material = $this->separateSaleRepo->find($id);
        return response()->json($material);
    }

    public function search($q,$x)
    {
        //$q = Input::get('q');
        $separateSales = $this->separateSaleRepo->search($q,$x);

        return response()->json($separateSales);
    } 
    public function edit(Request $request)
    {
        //var_dump($request->all()); die();

        /*\DB::beginTransaction();

        $varDetOrders = $request->detOrder;
        
        $detOrderSaleRepo;
        foreach($varDetOrders as $object){
            $detOrderSaleRepo = new DetSeparateSaleRepo;

            $detorderSale = $detOrderSaleRepo->find($object['id']);
            $manager = new DetSeparateSaleManager($detorderSale,$object);
            $manager->save();

            $stokRepo;
            $stokRepo = new StockRepo;
            $cajaSave=$stokRepo->getModel();
            $stockOri = $stokRepo->find($object['id']);

            $stock = $stokRepo->find($object['idStock']);
            if ($object['estad']==true) {
                $stock->stockSeparados= $stock->stockSeparados-$object['canPendiente'];
            }else{
                $stock->stockSeparados= $stock->stockSeparados+$object['canPendiente'];
            }

            $stock->save();
        }

        $orderSale = $this->separateSaleRepo->find($request->id);
        $manager = new SeparateSaleManager($orderSale,$request->all());
        $manager->save();




        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$orderSale->nombre]);*/

        //var_dump($separateSale->sale->id);
        //die();
        \DB::beginTransaction();

        $tipo = $request->input('tipo');

        $varDetOrders = $request->detOrder;
        $varPayment = $request->payment;
        $cajaAct = $request->caja;
        //$movimiento = $request->movimiento;
        $movimiento = [];
        $devolucion = $request->input('devolucion');

        /*********************************************************************************************/
        /***MOVIMIENTO DE CAJA***/

        if($devolucion == 1) { //si desea devolucion, es negativo cuando se pasa de la fecha maxima de recojo..

            if ($varPayment['Acuenta'] > 0) { //si considera los pagos en tarjeta, calculados en controllers.js
                //---create movimiento---
                //var_dump($request->movimiento);die();
                $detCashrepo;
                $movimiento['observacion'] = "temporal";
                $movimiento['fecha'] = date('Y-m-d');
                $movimiento['hora'] = date('H:i:s');
                $movimiento['montoCaja'] = $cajaAct['montoBruto'];
                $movimiento['montoMovimientoEfectivo'] = $varPayment['Acuenta'];
                $movimiento['montoFinal'] = $movimiento['montoCaja'] - $movimiento['montoMovimientoEfectivo'];
                $movimiento['estado'] = 1;
                $movimiento['cashMotive_id'] = 18;
                $movimiento['cash_id'] = $cajaAct['id'];
                $detCashrepo = new DetCashRepo;
                $movimientoSave = $detCashrepo->getModel();

                $insertarMovimiento = new DetCashManager($movimientoSave, $movimiento);
                $insertarMovimiento->save();
                //---Autualizar Caja---


                $cashrepo;
                $cashrepo = new CashRepo;
                $cajaSave = $cashrepo->getModel();
                $cash1 = $cashrepo->find($cajaAct["id"]);

                $cash1->montoBruto = $movimiento['montoFinal'];

                //$manager1 = new CashManager($cash1,$cajaAct);
                //$manager1->save();
                $cash1->save();
                //----------------

                $salePaymentRepo;
                $salePaymentRepo = new SalePaymentRepo;
                //$payment = $salePaymentRepo->find($varPayment['id']);
                $payment = $salePaymentRepo->find($varPayment['id']);

                $payment->Acuenta = 0;
                $payment->Saldo = $varPayment['Acuenta'];
                $payment->save();

                //$manager = new SalePaymentManager($payment,$varPayment);
                //$manager->save();

            }
        }
        /*********************************************************************************************/
        /***FIN MOVIMIENTO DE CAJA***/


        /*********************************************************************************************/
        /***REPOSICIÓN DE STOCK ***/

        $HeadStockRepo;
        $codigoHeadIS=0;

        //$detOrderSaleRepo;
        foreach($varDetOrders as $object){ //DETORDERS
            //$detOrderSaleRepo = new DetSaleRepo;

            //$detorderSale = $detOrderSaleRepo->find($object['id']);
            //$manager = new DetSaleManager($detorderSale,$object);
            //$manager->save();

            $stokRepo;
            $stokRepo = new StockRepo;
            $cajaSave=$stokRepo->getModel();
            $stockOri = $stokRepo->find($object['id']);

            $stock = $stokRepo->find($object['idStock']);
            //+++if ($object['estad']==true) {
            if($tipo == 2){ //PEDIDOS
                $stock->stockActual = $stock->stockActual + $object['canEntregado'];
                $stock->stockPedidos = $stock->stockPedidos - $object['canPendiente'];
            }elseif($tipo == 1) { //SEPARADOS
                $stock->stockActual = $stock->stockActual + $object['canEntregado'];
                $stock->stockSeparados = $stock->stockSeparados - $object['canPendiente']; // eliminar todos los separados
            }
            //+++}else{
            //+++$stock->stockPedidos= $stock->stockPedidos+$object['canPendiente'];
            //+++}

            $stock->save();

            //--------------reporte stock------------
            $object["variant_id"]=$object['vari'];
            if($codigoHeadIS===0){
                //$object["warehouses_id"]=$object['idAlmacen'];
                $object["warehouses_id"]=1;
                //$object["cantidad_llegado"]=$cantidaCalculada;
                //$object['descripcion']='Entrada por compra';
                //$object['tipo']='Entrada Venta';
                $object['tipo']='Entrada-Anulado-Separado';
                $object["user_id"]=auth()->user()->id;
                //$object["Fecha"]=$request->input("fechaPedido");
                $object["Fecha"]= date('Y-m-d H:i:s');

                $HeadStockRepo = new HeadInputStockRepo;
                $HeadStock=$HeadStockRepo->getModel();
                $HeadStockinsert=new HeadInputStockManager($HeadStock,$object);
                $HeadStockinsert->save();
                $codigoHeadIS=$HeadStock->id;
            }

            $object['headInputStock_id']=$codigoHeadIS;
            $object["producto"]=$object['nameProducto']."(".$object['NombreAtributos'].")";
            $object["cantidad_llegado"]=$object['canEntregado'];
            $object['descripcion']='Entrada-Separado-Anulado';

            $inputRepo;
            $inputRepo = new InputStockRepo;
            $inputstock=$inputRepo->getModel();
            $inputInsert=new InputStockManager($inputstock,$object);
            $inputInsert->save();
            //---------------------------------------
        }
        /*********************************************************************************************/
        /***FIN REPOSICIÓN DE STOCK ***/

        $separateSale = $this->separateSaleRepo->find($request->id);

        if($request->input('estado') == '3'){
            $request->merge(array('fechaAnulado' => date('Y-m-d H:i:s')));
        }
        //$manager = new SeparateSaleManager($separateSale,$request->all());
        //$manager->save();

        if($request->input('estado') == '3'){
            $separateSale->fechaAnulado = date('Y-m-d H:i:s');
        }
        $separateSale->estado = $request->input('estado');
        $separateSale->save();

        $sale = $separateSale->sale;

        //var_dump(count($sale)); die();

        if(count($sale)>0){
            if($request->input('estado') == '3'){
                $sale->fechaAnulado = date('Y-m-d H:i:s');
                $sale->estado = $request->input('estado');
                $sale->save();
            }
        }

        \DB::commit();

        return response()->json(['estado'=>true, 'nombre'=>$separateSale->nombre]);



    }
    public function ReportePedidos($fecha1,$fecha2,$tipo,$estado){
        if($tipo==0){
            $tipo="%%";
        }
         if($estado==0){
            $estado="%%";
        }
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_SubReportVentas2';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/SubReportVentas2.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini'=>$fecha1,'fechafin'=>$fecha2,'SUBREPORT_DIR'=> public_path() . '/report/','tipo'=>$tipo,'estado'=>$estado],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_SubReportVentas2.'.$ext;
    }
}