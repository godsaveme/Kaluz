<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SaleRepo;
use Salesfly\Salesfly\Managers\SaleManager;

use Salesfly\Salesfly\Repositories\OrderSaleRepo;
use Salesfly\Salesfly\Managers\OrderSaleManager;

use Salesfly\Salesfly\Repositories\DetOrderSaleRepo;
use Salesfly\Salesfly\Managers\DetOrderSaleManager;

use Salesfly\Salesfly\Repositories\SeparateSaleRepo;
use Salesfly\Salesfly\Managers\SeparateSaleManager;

use Salesfly\Salesfly\Repositories\DetSeparateSaleRepo;
use Salesfly\Salesfly\Managers\DetSeparateSaleManager;

use Salesfly\Salesfly\Repositories\DetSaleRepo;
use Salesfly\Salesfly\Managers\DetSaleManager;

use Salesfly\Salesfly\Repositories\CustomerRepo;
use Salesfly\Salesfly\Managers\CustomerManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Managers\SalePaymentManager;
use Salesfly\Salesfly\Repositories\SalePaymentRepo;

use Salesfly\Salesfly\Managers\DetCashManager;
use Salesfly\Salesfly\Repositories\DetCashRepo;

use Salesfly\Salesfly\Managers\HeadInputStockManager;
use Salesfly\Salesfly\Repositories\HeadInputStockRepo;

use Salesfly\Salesfly\Managers\InputStockManager;
use Salesfly\Salesfly\Repositories\InputStockRepo;

use Salesfly\Salesfly\Managers\SaleDetPaymentManager;
use Salesfly\Salesfly\Repositories\SaleDetPaymentRepo;
use Salesfly\Salesfly\Managers\StockManager;
use Salesfly\Salesfly\Repositories\StockRepo;

use Salesfly\Salesfly\Repositories\CashHeaderRepo;

use Salesfly\Salesfly\Managers\HeadInvoiceManager;
use Salesfly\Salesfly\Repositories\HeadInvoiceRepo;
use Salesfly\Salesfly\Managers\DetailInvoiceManager;
use Salesfly\Salesfly\Repositories\DetailInvoiceRepo;
use Salesfly\Salesfly\Managers\FBnumberManager;
use Salesfly\Salesfly\Repositories\FBnumberRepo;
class SalesController extends Controller
{
    protected $saleRepo;

    public function __construct(SaleRepo $saleRepo,CashHeaderRepo $ashHeaderRepo,HeadInvoiceRepo $headInvoiceRepo)
    {
        $this->saleRepo = $saleRepo;
        $this->ashHeaderRepo = $ashHeaderRepo;
        $this->headInvoiceRepo=$headInvoiceRepo;
    }

    public function all()
    {
        $orders = $this->saleRepo->paginate(15);
        return response()->json($orders);
        //var_dump($materials);
    }
    public function DatosDocumento($id){
       $orders = $this->headInvoiceRepo->DatosDocumento($id);
        return response()->json($orders);
     }
    public function paginatep(){
        $orders = $this->saleRepo->paginate(15);
        return response()->json($orders);
    }

    public function find($id)
    {
        $cash = $this->saleRepo->find($id);
        return response()->json($cash);
    }

    public function search($q)
    {
        $orders = $this->saleRepo->search($q);

        return response()->json($orders);
    }
    public function index()
    {
        return View('sales.index');
    }
    public function form_create()
    {
        return View('sales.form_create');
    }
    public function form_edit()
    {
        return View('sales.form_edit');
    }

    public function create(Request $request) 
        {
        //var_dump($request->all());die();
           \DB::beginTransaction();
        $orderSale = $this->saleRepo->getModel();
        $var = $request->detOrders;
        $payment = $request->salePayment;
        $saledetPayments = $request->saledetPayments;

        //$almacen_id=$var->input("idAlmacen");
        //$variante_id=$var->input("vari");
        
        
        //$codSale=$orderSale->id;
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
            $movimiento['observacion']="Temporal";
            $detCashrepo = new DetCashRepo;
            $movimientoSave=$detCashrepo->getModel();

            $movimiento['fecha'] = date('Y-m-d');
            $movimiento['hora'] = date('H:i:s');
        
            $insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            $insertarMovimiento->save();
            $detCash_id=$movimientoSave->id;
    //---Autualizar Caja---
            
            $cajaAct = $request->caja;
            $cashrepo;
            //$movimiento['observacion']=$temporal;
            $cashrepo = new CashRepo;
            $cajaSave=$cashrepo->getModel();
            //var_dump($cajaAct);die();

            $cash1 = $cashrepo->find($cajaAct["id"]);

            //var_dump($cash1["id"]);die();
        
            //$insertarMovimiento=new DetCashManager($movimientoSave,$movimiento);
            //$insertarMovimiento->save();

            //$stores = $this->storeRepo->find($request->id);
            //var_dump($cash1);die();

            $manager1 = new CashManager($cash1,$cajaAct);
            $manager1->save();
            $request->merge(['detCash_id'=> $detCash_id]);
            $request->merge(['fechaPedido' => date('Y-m-d H:i:s')]);

            if($payment['Saldo'] > 0) $request->merge(['estado' => 0]);

           $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
        //----------------
        $salePaymentrepo;
        $payment['sale_id']=$temporal;
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
            //--------------------------
    if(!empty($request->input("comprobante"))){
            ///var_dump("kkdkdkkdsk");die();
            $headInvoiceRepo=new HeadInvoiceRepo;
            $headInvoice=$headInvoiceRepo->getModel();
            $customerRepo=new CustomerRepo;
            $direccion=$customerRepo->find($request->input("customer_id"));
            $fbnumberRepo=new FBnumberRepo;
            $ashHeaderRepo=$this->ashHeaderRepo->comprobarCaja($cash1["id"]);
            $numbers=$fbnumberRepo->find($ashHeaderRepo["id"]);
            //var_dump($ashHeaderRepo["id"]);die();
            $num=$fbnumberRepo->find($ashHeaderRepo["id"]);
            if($request->input("tipoDoc")=="F"){
                 $request->merge(["numero"=>(intval($num->numFactura)+1)]);
                 $request->merge(["numFactura"=>$request->input("numero")]);
                 $request->merge(["cliente"=>$direccion["empresa"]]);
                 $request->merge(["direccion"=>$direccion["direccFiscal"]]);
                 $request->merge(["ruc"=>$direccion["ruc"]]);
                 $inputfbnumber=new FBnumberManager($numbers,$request->only("numFactura"));
                 $inputfbnumber->save();
            }else{
                 $request->merge(["cliente"=>$direccion["nombres"]." ".$direccion["apellidos"]]);
                 $request->merge(["direccion"=>$direccion["direccContac"]]);
                 $request->merge(["numero"=>(intval($num->numBoleta)+1)]);
                 $request->merge(["numBoleta"=>$request->input("numero")]);
                 $request->merge(["ruc"=>$direccion["dni"]]);
                 $inputfbnumber=new FBnumberManager($numbers,$request->only("numBoleta"));
                 $inputfbnumber->save();
            }
            
            
           

            $request->merge(["subTotal"=>$request->input("montoBruto")]);
            $request->merge(["Total"=>$request->input("montoTotal")]);
            $request->merge(["venta_id"=>$temporal]);
            $request->merge(["cliente_id"=>$request->input("customer_id")]);
           
            $inputheadInvoiceRepo=new HeadInvoiceManager($headInvoice,
            $request->only('numero','cliente','direccion','ruc','GRemicion','subTotal',
                'igv','Total','venta_id','cliente_id','tipoDoc','vuelto'));
            $inputheadInvoiceRepo->save();
            $codigoFactura=$headInvoice->id;
            
     }
        //----------------

        $detOrderrepox;
        $HeadStockRepo;
         $codigoHeadIS=0;
       foreach($var as $object){
        $object['sale_id'] = $temporal;

           

           $detOrderrepox = new DetSaleRepo;

           $insertar=new DetSaleManager($detOrderrepox->getModel(),$object);
           $insertar->save();
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
                  //var_dump($stockac);die();
            //--------------reporte stock------------
          if($codigoHeadIS===0){
            $object["warehouses_id"]=$object['idAlmacen'];
            //$object["cantidad_llegado"]=$cantidaCalculada;
            //$object['descripcion']='Entrada por compra';
            $object['tipo']='Venta';
            $object["user_id"]=auth()->user()->id;
            $object["Fecha"]=$request->input("fechaPedido");

            $HeadStockRepo = new HeadInputStockRepo;
            $HeadStock=$HeadStockRepo->getModel();
            $HeadStockinsert=new HeadInputStockManager($HeadStock,$object);
            $HeadStockinsert->save();
            $codigoHeadIS=$HeadStock->id;
          }

          $object['headInputStock_id']=$codigoHeadIS;
          $object["producto"]=$object['NombreProducto'];
          $object["cantidad_llegado"]=$object['cantidad'];
          $object['descripcion']='Salida por Venta';
          
          $inputRepo;
          $inputRepo = new InputStockRepo;
            $inputstock=$inputRepo->getModel();
            $inputInsert=new InputStockManager($inputstock,$object);
            $inputInsert->save();
          //---------------------------------------


            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]);//
                  
                }else{
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]*$object["equivalencia"]);
                  
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  //$stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
            //Create det Documento Venta 
            //-------------------------------------------------------
            if(!empty($codigoFactura)){
                  $object["descripcion"]=$object["NombreProducto"];
                  $object["PrecioUnit"]=$object["precioProducto"];
                  $object["PrecioVent"]=$object["subTotal"];
                  $object["headInvoice_id"]=$codigoFactura;
                  $detInvoice=new DetailInvoiceRepo;
                  $insertDetInvoice=new DetailInvoiceManager($detInvoice->getModel(),$object);
                  $insertDetInvoice->save();
          }
            //------------------------------------------------------
       }
       //-----------------Creacion de Cabecera Factura-------
       //$cajaPrueba=$request->saledetPayments;
      \DB::commit();
     return response()->json(['estado'=>true,'codFactura'=>$codigoFactura,'nombres'=>$orderSale->nombres]);
    }


    public function createSeparateSale(Request $request) 
        {
          //var_dump($request->all()); die();
            \DB::beginTransaction();
            $tipo = $request->input('tipo');
          //---------------------- 
          $orderRepo;
            $orderRepo = new SeparateSaleRepo;
            $cajaSave=$orderRepo->getModel();
            $cash1 = $orderRepo->find($request->id);

            /*
            ADD ESTADOS A SALES
            */
            $request->merge(array('estado' => 2));
            /*
             *
             */

            $manager1 = new SeparateSaleManager($cash1,$request->except('fechaPedido'));
            $manager1->save();
        //---------------------
        $var = $request->detOrders;
        $request->merge(array('estado' => '0'));
        //$request->merge(array('estado' => '0'));
            //ELIMINAR ENVIAR A VENTAS SEPARADO UNA VEZ TERMINADO
        /*$orderSale = $this->saleRepo->getModel();
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
 
        $orderSale->save();
        $temporal=$orderSale->id;*/
        
          //----------------------    elimn

        $detOrderrepox;
        $montoventa=0;
         $HeadStockRepo;
         $codigoHeadIS=0;
       foreach($var as $object) { //detORDERS
           if ($object['estad'] == false){
               //------Actualizar pedido------
               //$cajaAct = $request->caja;
               //var_dump($object);die();
               $saleDet;
           $saleDet = new DetSeparateSaleRepo;
           //$object=$saleDet->getModel();

           $saled = $saleDet->find($object['id']);
           //var_dump($saled);die();

           $manager2 = new DetSeparateSaleManager($saled, $object);
           $manager2->save();
           //-----------------------------
               /** delete add detSAle */
               /*$object['sale_id'] = $temporal; //detSALE
           $object['cantidad'] = $object['parteEntregado'];
           $object['subTotal'] = $object['precioVenta'] * $object['parteEntregado'];
           $montoventa = $montoventa + $object['subTotal'];


               $detOrderrepox = new DetSaleRepo;

           $insertar = new DetSaleManager($detOrderrepox->getModel(), $object);
           if ($object['parteEntregado'] > 0) {
               $insertar->save();
           }


           $detOrderrepox = null;*/
               /** end add detsale */

           //-------------------------------------

           $stockmodel = new StockRepo;
           $object['warehouse_id'] = $object['idAlmacen'];
           $object["variant_id"] = $object['vari'];
           $stockac = $stockmodel->encontrar($object["variant_id"], $object['warehouse_id']);
           //var_dump($stockac);die();

           //--------------reporte stock------------
           if ($codigoHeadIS === 0) {
               $object["warehouses_id"] = $object['idAlmacen'];
               //$object["cantidad_llegado"]=$cantidaCalculada;
               //$object['descripcion']='Entrada por compra';
               $object['tipo'] = 'Venta';
               $object["user_id"] = auth()->user()->id;
               //$object["Fecha"] = $request->input("fechaPedido");
               $object["Fecha"] = date('Y-m-d H:i:s');

               $HeadStockRepo = new HeadInputStockRepo;
               $HeadStock = $HeadStockRepo->getModel();
               $HeadStockinsert = new HeadInputStockManager($HeadStock, $object);
               $HeadStockinsert->save();
               $codigoHeadIS = $HeadStock->id;
           }

           $object['headInputStock_id'] = $codigoHeadIS;
           $object["producto"] = $object['nameProducto'] . "(" . $object['NombreAtributos'] . ")";
           $object["cantidad_llegado"] = $object['cantidad'];
           $object['descripcion'] = 'Salida por Venta';

           $inputRepo;
           $inputRepo = new InputStockRepo;
           $inputstock = $inputRepo->getModel();
           $inputInsert = new InputStockManager($inputstock, $object);
           $inputInsert->save();
           //---------------------------------------

           if (!empty($stockac)) {

               if($tipo == 2){ //PEDIDOS

                   if ($object["equivalencia"] == null) {

                       $object["stockPedidos"] = $stockac->stockPedidos - ($object["cantidad"]);
                       $object["stockActual"] = $stockac->stockActual - ($object["cantidad"]);//

                   } else {
                       $object["stockActual"] = $stockac->stockActual - ($object["cantidad"] * $object["equivalencia"]);
                       $object["stockPedidos"] = $stockac->stockPedidos - ($object["cantidad"] * $object["equivalencia"]);
                   }
               }elseif($tipo == 1) { //SEPARADOS

                   if ($object["equivalencia"] == null) {
                       $object["stockSeparados"] = $stockac->stockSeparados - ($object["cantidad"]);
                       $object["stockActual"] = $stockac->stockActual - ($object["cantidad"]);//

                   } else {
                       $object["stockActual"] = $stockac->stockActual - ($object["cantidad"] * $object["equivalencia"]);
                       $object["stockSeparados"] = $stockac->stockSeparados - ($object["cantidad"] * $object["equivalencia"]);
                   }
               }
               $manager = new StockManager($stockac, $object);
               $manager->save();
               //$stock=null;
           } else {

           }
           $stockac = null;
           //-----------------------------------------------------
       }
       }
            $subTotal=$montoventa/1.18;
            $montoIgv=$montoventa-$subTotal;

            $request->merge(array('montoTotal' => $montoventa));
            $request->merge(array('igv' => $montoIgv));
            $request->merge(array('montoBruto' => $subTotal));

            /*
             ADD ESTADOS A SALES
             */
                $request->merge(array('estado' => 1));
            //fecha
                $request->merge(array('fechaPedido' => date('Y-m-d H:i:s')));
            /*
             *
             */
            /** delete create sale  */
            /*$sales=$this->saleRepo->find($temporal);
            $manager = new SaleManager($sales,$request->all());
            $manager->save();*/

            \DB::commit();

     return response()->json(['estado'=>true]);
    }

    public function createSale(Request $request) 
        {
          
          //---------------------- 
          $orderRepo;
            $orderRepo = new OrderSaleRepo;
            $cajaSave=$orderRepo->getModel();
            $cash1 = $orderRepo->find($request->id);

            $manager1 = new OrderSaleManager($cash1,$request->all());
            $manager1->save();
        //---------------------
        $var = $request->detOrders;
        $request->merge(array('estado' => '0'));
        //$request->merge(array('estado' => '0'));
        $orderSale = $this->saleRepo->getModel();
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();
 
        $orderSale->save();
        $temporal=$orderSale->id;
        
          //----------------------      

        $detOrderrepox;
        $montoventa=0;

         $HeadStockRepo;
         $codigoHeadIS=0;
        
       foreach($var as $object){
          
          //------Actualizar pedido------
          //$cajaAct = $request->caja;
          //var_dump($object);die();
            $saleDet;
            $saleDet = new DetOrderSaleRepo;
            //$object=$saleDet->getModel();
            
            $saled = $saleDet->find($object['id'] );
            //var_dump($saled);die();

            $manager2 = new DetOrderSaleManager($saled,$object);
            $manager2->save();
          //-----------------------------
           $object['sale_id'] = $temporal;
           $object['cantidad'] = $object['parteEntregado'];
           $object['subTotal'] = $object['precioVenta']*$object['parteEntregado'];
           $montoventa=$montoventa+$object['subTotal'];
           $detOrderrepox = new DetSaleRepo;

           $insertar=new DetSaleManager($detOrderrepox->getModel(),$object);
           if($object['parteEntregado']>0){$insertar->save();}
           
          
           $detOrderrepox = null;

           //-------------------------------------
           
           $stockmodel = new StockRepo;
                  $object['warehouse_id']=$object['idAlmacen'];
                  $object["variant_id"]=$object['vari'];
                  $stockac=$stockmodel->encontrar($object["variant_id"],$object['warehouse_id']);
                  //var_dump($stockac);die();

                  //--------------reporte stock------------
          if($codigoHeadIS===0){
            $object["warehouses_id"]=$object['idAlmacen'];
            //$object["cantidad_llegado"]=$cantidaCalculada;
            //$object['descripcion']='Entrada por compra';
            $object['tipo']='Venta';
            $object["user_id"]=auth()->user()->id;
            $object["Fecha"]=$request->input("fechaPedido");

            $HeadStockRepo = new HeadInputStockRepo;
            $HeadStock=$HeadStockRepo->getModel();
            $HeadStockinsert=new HeadInputStockManager($HeadStock,$object);
            $HeadStockinsert->save();
            $codigoHeadIS=$HeadStock->id;
          }

          $object['headInputStock_id']=$codigoHeadIS;
          $object["producto"]=$object['nameProducto']."(".$object['NombreAtributos'].")";
          $object["cantidad_llegado"]=$object['cantidad'];
          $object['descripcion']='Salida por Venta';
          
          $inputRepo;
          $inputRepo = new InputStockRepo;
            $inputstock=$inputRepo->getModel();
            $inputInsert=new InputStockManager($inputstock,$object);
            $inputInsert->save();
          //---------------------------------------

            if(!empty($stockac)){
             
                if($object["equivalencia"]==null){
                  $object["stockPedidos"]=$stockac->stockPedidos-($object["cantidad"]);
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]);//
                  
                }else{
                  $object["stockActual"]=$stockac->stockActual-($object["cantidad"]*$object["equivalencia"]);
                  $object["stockPedidos"]=$stockac->stockPedidos-($object["cantidad"]*$object["equivalencia"]);
                }
                  $manager = new StockManager($stockac,$object);
                  $manager->save();
                  //$stock=null;
            }else{
                
            }
            $stockac=null;
            //-----------------------------------------------------
       }
            $subTotal=$montoventa/1.18;
            $montoIgv=$montoventa-$subTotal;

            $request->merge(array('montoTotal' => $montoventa));
            $request->merge(array('igv' => $montoIgv));
            $request->merge(array('montoBruto' => $subTotal));

            $sales=$this->saleRepo->find($temporal);
            $manager = new SaleManager($sales,$request->all());
            $manager->save();
     return response()->json(['estado'=>true, 'nombres'=>$orderSale->nombres]);
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function edit(Request $request)
    {
        //var_dump($request->all());
        //die();
        \DB::beginTransaction();
        $varDetOrders = $request->detOrder;
        $varPayment = $request->payment;
        $movimiento = $request->movimiento;
        if ($movimiento['montoMovimientoEfectivo']>0) { //si considera los pagos en tarjeta, calculados en controllers.js
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
        //$payment = $salePaymentRepo->find($varPayment['id']);
        $payment = $salePaymentRepo->find($varPayment['idPAY']);
        $manager = new SalePaymentManager($payment,$varPayment);
        $manager->save();

        }
        
        $HeadStockRepo;
         $codigoHeadIS=0;
         
        //$detOrderSaleRepo;
        foreach($varDetOrders as $object){
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
                $stock->stockActual= $stock->stockActual+$object['cantidad'];
            //+++}else{
                //+++$stock->stockPedidos= $stock->stockPedidos+$object['canPendiente'];
            //+++}

            $stock->save();

            //--------------reporte stock------------
            $object["variant_id"]=$object['vari'];
          if($codigoHeadIS===0){
            $object["warehouses_id"]=$object['idAlmacen'];
            //$object["cantidad_llegado"]=$cantidaCalculada;
            //$object['descripcion']='Entrada por compra';
            //$object['tipo']='Entrada Venta';
            $object['tipo']='Entrada-Anulado';
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
          $object["cantidad_llegado"]=$object['cantidad'];
          $object['descripcion']='Entrada-Venta-Anulada';
          
          $inputRepo;
          $inputRepo = new InputStockRepo;
            $inputstock=$inputRepo->getModel();
            $inputInsert=new InputStockManager($inputstock,$object);
            $inputInsert->save();
          //---------------------------------------
        }

        $orderSale = $this->saleRepo->find($request->id);
        if($request->input('estado') == '3'){
            $request->merge(array('fechaAnulado' => date('Y-m-d H:i:s')));
        }
        $manager = new SaleManager($orderSale,$request->all());
        $manager->save();



        \DB::commit();

        return response()->json(['estado'=>true, 'nombre'=>$orderSale->nombre]);
    }
    public function factura($id){
           $headIvoiceRepo = new HeadInvoiceRepo;
           $orders = $headIvoiceRepo->consult($id);
        return response()->json($orders);
    }
    public function detfactura($id){
           $detailIvoiceRepo = new DetailInvoiceRepo;
           $orders = $detailIvoiceRepo->detFactura($id);
        return response()->json($orders);
    }
     public function numeracion($tipo,$id){
           $headIvoiceRepo = new FBnumberRepo;
           $orders = $headIvoiceRepo->numeracion($tipo,$id);
        return response()->json($orders);
    }
    
    public function reporteFactura(){
        //var_dump($estado);die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_Boleta';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/Boleta.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            //['SUBREPORT_DIR'=> public_path() . '/report/','estado'=>$estado],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'Boleta.'.$ext;
    }
    
    public function ReportVentas($fecha1,$fecha2){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_SubReportVentas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/SubReportVentas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini'=>$fecha1,'fechafin'=>$fecha2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_SubReportVentas.'.$ext;
    }

}
