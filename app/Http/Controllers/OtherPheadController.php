<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OtherPheadRepo;
use Salesfly\Salesfly\Managers\OtherPheadManager;

use Salesfly\Salesfly\Repositories\OtherPdetailRepo;
use Salesfly\Salesfly\Managers\OtherPdetailManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

use Salesfly\Salesfly\Repositories\ExpenseRepo;
use Salesfly\Salesfly\Managers\ExpenseManager;

use Salesfly\Salesfly\Repositories\DetExpenseRepo;
use Salesfly\Salesfly\Managers\DetExpenseManager;

use Salesfly\Salesfly\Repositories\CashMonthlyRepo;
use Salesfly\Salesfly\Managers\CashMonthlyManager;

class OtherPheadController extends Controller {

    public function __construct(OtherPheadRepo $otherPheadRepo,OtherPdetailRepo $otherPdetailRepo,DetCashRepo $detCashRepo,CashRepo $cashRepo,CashMonthlyRepo $cashMonthlyRepo,ExpenseRepo $expenseRepo,DetExpenseRepo $detExpenseRepo)
    {
        $this->otherPheadRepo = $otherPheadRepo;
        $this->otherPdetailRepo= $otherPdetailRepo;
        $this->detCashRepo= $detCashRepo;
        $this->cashRepo= $cashRepo;
        $this->cashMonthlyRepo= $cashMonthlyRepo;
        $this->expenseRepo= $expenseRepo;
        $this->detExpenseRepo= $detExpenseRepo;
    }

    public function index()
    {
        return View('otherPheads.index');
    }

    public function all()
    {
        $brands = $this->brandRepo->paginate(15);
        return response()->json($brands);
        //var_dump($brands);
    }
    public function pagosCompras($id){
         $otherPhead = $this->detCashRepo->pagosCompras($id);
         $cashMonthly = $this->cashMonthlyRepo->pagosCompras($id);
         foreach ($cashMonthly as $value) {
              $otherPhead[count($otherPhead)]=$value;
         }
         
        return response()->json($otherPhead);
    }
    public function pagosCompras3($id){
         $otherPhead = $this->detCashRepo->gastos($id);
         $cashMonthly = $this->cashMonthlyRepo->gastos($id);
         foreach ($cashMonthly as $value) {
              $otherPhead[count($otherPhead)]=$value;
         }
         
        return response()->json($otherPhead);
    }
    public function pagosCompras2($id){
         $total=0;
         $otherPhead = $this->detCashRepo->pagosCompras($id);
         foreach ($otherPhead as $value) {
              $total= $total+floatval($value["monto"]);
         }
         $cashMonthly = $this->cashMonthlyRepo->pagosCompras($id);
         foreach ($cashMonthly as $value2) {
              $total= $total+floatval($value2["monto"]);
         }
         
        return $total;
    }

    public function paginatep(){
        $otherPhead = $this->otherPheadRepo->paginate(15);
        return response()->json($otherPhead);
    }
    public function paginatepGastos(){
        $expense = $this->expenseRepo->paginate(15);
        return response()->json($expense);
    }

    public function form_create()
    {
        return View('otherPheads.form_create');
    }

    public function form_edit()
    {
        return View('otherPheads.form_edit');
    }

    public function create(Request $request)
    {
        //var_dump($request->all());die();
        \DB::beginTransaction();
        $otherPhead = $this->otherPheadRepo->getModel();
        $var=$request->detalles;
        $request->merge(["Saldo"=>$request->input("MontoTotal")]);
        $request->merge(["montoPagado"=>0]);
        $manager = new OtherPheadManager($otherPhead,$request->all());
        //print_r($manager); die();
        $manager->save();
        //var_dump($request->all());
        //die();
        $idHead=$otherPhead->id;
        foreach ($var as $object) {
            $object['otherPhead_id']=$idHead;
            $otherPdetailRepo = new OtherPdetailRepo;
            $otherPdetail=new OtherPdetailManager($otherPdetailRepo->getModel(),$object);
            $otherPdetail->save();
        }
      
        //Event::fire('update.brand',$brand->all());
      \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function createGasto(Request $request)
    {
        //var_dump($request->all());die();
        \DB::beginTransaction();
        $expense = $this->expenseRepo->getModel();
        $var=$request->detalles;
        $request->merge(["Saldo"=>$request->input("MontoTotal")]);
        $request->merge(["montoPagado"=>0]);
        $manager = new ExpenseManager($expense,$request->all());
        //print_r($manager); die();
        $manager->save();
        //var_dump($request->all());
        //die();
        $idHead=$expense->id;
        foreach ($var as $object) {
            $object['expense_id']=$idHead;
            //$object['total']=$object['PrecioFinal'];
            //$object['cashmotive_id']=$object['cuenta'];
            $detExpenseRepo = new DetExpenseRepo;
            $otherPdetail=new DetExpenseManager($detExpenseRepo->getModel(),$object);
            $otherPdetail->save();
        }
      
        //Event::fire('update.brand',$brand->all());
      \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function createPago(Request $request)
    {
       //var_dump($request->all());die();
        \DB::beginTransaction();
        $otherPhead = $this->otherPheadRepo->find($request->idpago);
        $request->merge(["montoPagado"=>floatval($otherPhead->montoPagado)+floatval($request->input("monto"))]);
        $request->merge(["Saldo"=>floatval($otherPhead->Saldo)-floatval($request->input("monto"))]);

       if(!empty($request->input('cashe_id'))){
        $caja=$this->cashRepo->find($request->input('cashe_id'));
        $request->merge(['montoCaja'=>$caja->montoBruto]);
        $detCash = $this->detCashRepo->getModel();
        //var_dump($caja);die();
        $request->merge(['gastos'=>($caja->gastos+$request->input('monto'))]);
        $request->merge(['montoBruto'=>floatval($caja->ingresos+$caja->montoInicial)-floatval($request->input('gastos'))]);
        $request->merge(['montoInicial'=>$caja->montoInicial]);
        $request->merge(['fechaInicio'=>$caja->fechaInicio]);
        $request->merge(['ingresos'=>$caja->ingresos]);
        $request->merge(['montoReal'=>$caja->montoReal]);
        $request->merge(['descuadre'=>$caja->descuadre]);
        $request->merge(['estado'=>$caja->estado]);
        $request->merge(['cashHeader_id'=>$caja->cashHeader_id]);
        $request->merge(['user_id'=>$caja->user_id]);
        
        $manager = new CashManager($caja,$request->all());
        $manager->save();

        
        $request->merge(['montoMovimientoTarjeta'=>0]);
        $request->merge(['montoMovimientoEfectivo'=>$request->input('monto')]);
        $request->merge(['montoFinal'=>$request->input('montoBruto')]);
        $request->merge(['estado'=>1]);
        $request->merge(['observacion'=>'Compra de insumos y otros']);
        $request->merge(['cashMotive_id'=>7]);
        $request->merge(['cash_id'=>$request->input('cashe_id')]);
        //var_dump($request->input('idpago'));die();
        $request->merge(['otherPhead_id'=>$request->input('idpago')]);
        //$cash = $this->CashRepo->getModel();
       // $var=$request->detalles;
       
        
        $detcash = new detCashManager($detCash,$request->all());
        $detcash->save();
    }else{
        $cashMonthly=$this->cashMonthlyRepo->getModel();
        $request->merge(['amount'=>$request->input('monto')]);
        $request->merge(['descripcion'=>'Pago Por insumos y otros']);
        $request->merge(['expenseMonthlys_id'=>1]);
        $request->merge(['otherPhead_id'=>$request->input('idpago')]);
         $detcash = new CashMonthlyManager($cashMonthly,$request->all());
        $detcash->save();
    }
        $request->merge(["fecha"=>$otherPhead->fecha]);
        $request->merge(["numeroDocumento"=>$otherPhead->numeroDocumento]);
        $request->merge(["proveedor"=>$otherPhead->proveedor]);
        $request->merge(["ruc"=>$otherPhead->ruc]);
        $compras = new OtherPheadManager($otherPhead,$request->only("fecha","numeroDocumento","proveedor","ruc","montoPagado","Saldo"));
        $compras->save();
     \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function createPago2(Request $request)
    {
       //var_dump($request->all());die();
        \DB::beginTransaction();
        $otherPhead = $this->expenseRepo->find($request->idpago);
        $request->merge(["montoPagado"=>floatval($otherPhead->montoPagado)+floatval($request->input("monto"))]);
        $request->merge(["Saldo"=>floatval($otherPhead->Saldo)-floatval($request->input("monto"))]);

       if(!empty($request->input('cashe_id'))){
        $caja=$this->cashRepo->find($request->input('cashe_id'));
        $request->merge(['montoCaja'=>$caja->montoBruto]);
        $detCash = $this->detCashRepo->getModel();
        //var_dump($caja);die();
        $request->merge(['gastos'=>($caja->gastos+$request->input('monto'))]);
        $request->merge(['montoBruto'=>floatval($caja->ingresos+$caja->montoInicial)-floatval($request->input('gastos'))]);
        $request->merge(['montoInicial'=>$caja->montoInicial]);
        $request->merge(['fechaInicio'=>$caja->fechaInicio]);
        $request->merge(['ingresos'=>$caja->ingresos]);
        $request->merge(['montoReal'=>$caja->montoReal]);
        $request->merge(['descuadre'=>$caja->descuadre]);
        $request->merge(['estado'=>$caja->estado]);
        $request->merge(['cashHeader_id'=>$caja->cashHeader_id]);
        $request->merge(['user_id'=>$caja->user_id]);
        
        $manager = new CashManager($caja,$request->all());
        $manager->save();

        
        $request->merge(['montoMovimientoTarjeta'=>0]);
        $request->merge(['montoMovimientoEfectivo'=>$request->input('monto')]);
        $request->merge(['montoFinal'=>$request->input('montoBruto')]);
        $request->merge(['estado'=>1]);
        $request->merge(['observacion'=>'Gastos Especiales']);
        $request->merge(['cashMotive_id'=>7]);
        $request->merge(['cash_id'=>$request->input('cashe_id')]);
        $request->merge(['expense_id'=>$request->input('idpago')]);
        //$cash = $this->CashRepo->getModel();
       // $var=$request->detalles;
       
        
        $detcash = new detCashManager($detCash,$request->all());
        $detcash->save();
    }else{
        $cashMonthly=$this->cashMonthlyRepo->getModel();
        $request->merge(['amount'=>$request->input('monto')]);
        $request->merge(['descripcion'=>'Pago Por insumos y otros']);
        $request->merge(['expenseMonthlys_id'=>1]);
        $request->merge(['expense_id'=>$request->input('idpago')]);
         $detcash = new CashMonthlyManager($cashMonthly,$request->all());
        $detcash->save();
    }
        $request->merge(["fecha"=>$otherPhead->fecha]);
        $request->merge(["numeroDocumento"=>$otherPhead->numeroDocumento]);
        $request->merge(["proveedor"=>$otherPhead->proveedor]);
        $request->merge(["ruc"=>$otherPhead->ruc]);
        $compras = new ExpenseManager($otherPhead,$request->only("fecha","numeroDocumento","proveedor","ruc","montoPagado","Saldo"));
        $compras->save();
     \DB::commit();
        return response()->json(['estado'=>true]);
    }
    public function destroyPagos(Request $request)
    {
        //var_dump($request->tipo);die();
         \DB::beginTransaction();
        $idCompra="";
        if($request->input('tipo')=='Caja'){
            $detCash=$this->detCashRepo->find($request->id);
            $caja=$this->cashRepo->find($detCash->cash_id);
            if($caja->estado==1) {  
             $idCompra=$detCash->otherPhead_id;     
       $request->merge(['gastos'=>(floatval($caja->gastos)-floatval($request->input('monto')))]);
       $request->merge(['montoBruto'=>floatval($caja->ingresos+$caja->montoInicial)-floatval($request->input('gastos'))]);
        $request->merge(['montoInicial'=>$caja->montoInicial]);
        $request->merge(['fechaInicio'=>$caja->fechaInicio]);
        $request->merge(['ingresos'=>$caja->ingresos]);
        $request->merge(['montoReal'=>$caja->montoReal]);
        $request->merge(['descuadre'=>$caja->descuadre]);
        $request->merge(['estado'=>$caja->estado]);
        $request->merge(['cashHeader_id'=>$caja->cashHeader_id]);
        $request->merge(['user_id'=>$caja->user_id]);
        
        $manager = new CashManager($caja,$request->all());
        $manager->save();
         $detCash->delete();
         
        }else{
            return response()->json(['estado'=>true,'nota'=>'Caja Cerrada']);
        }
        }else{
            $cashMonthly = $this->cashMonthlyRepo->find($request->id);
             $idCompra=$cashMonthly->otherPhead_id;
            $cashMonthly->delete();
            
        }
         $otherPhead = $this->otherPheadRepo->find($idCompra);
        $request->merge(["montoPagado"=>floatval($otherPhead->montoPagado)-floatval($request->input("monto"))]);
        $request->merge(["Saldo"=>floatval($otherPhead->Saldo)+floatval($request->input("monto"))]);
        $request->merge(["fecha"=>$otherPhead->fecha]);
        $request->merge(["numeroDocumento"=>$otherPhead->numeroDocumento]);
        $request->merge(["proveedor"=>$otherPhead->proveedor]);
        $request->merge(["ruc"=>$otherPhead->ruc]);
        $compras = new OtherPheadManager($otherPhead,$request->only("fecha","numeroDocumento","proveedor","ruc","montoPagado","Saldo"));
        $compras->save();
         
        \DB::commit();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
        
    }
    public function destroyPagos2(Request $request)
    {
        //var_dump($request->tipo);die();
         \DB::beginTransaction();
        $idCompra="";
        if($request->input('tipo')=='Caja'){
            $detCash=$this->detCashRepo->find($request->id);
            $caja=$this->cashRepo->find($detCash->cash_id);
            if($caja->estado==1) {  
             $idCompra=$detCash->expense_id;     
       $request->merge(['gastos'=>(floatval($caja->gastos)-floatval($request->input('monto')))]);
       $request->merge(['montoBruto'=>floatval($caja->ingresos+$caja->montoInicial)-floatval($request->input('gastos'))]);
        $request->merge(['montoInicial'=>$caja->montoInicial]);
        $request->merge(['fechaInicio'=>$caja->fechaInicio]);
        $request->merge(['ingresos'=>$caja->ingresos]);
        $request->merge(['montoReal'=>$caja->montoReal]);
        $request->merge(['descuadre'=>$caja->descuadre]);
        $request->merge(['estado'=>$caja->estado]);
        $request->merge(['cashHeader_id'=>$caja->cashHeader_id]);
        $request->merge(['user_id'=>$caja->user_id]);
        
        $manager = new CashManager($caja,$request->all());
        $manager->save();
         $detCash->delete();
         
        }else{
            return response()->json(['estado'=>true,'nota'=>'Caja Cerrada']);
        }
        }else{
            $cashMonthly = $this->cashMonthlyRepo->find($request->id);
             $idCompra=$cashMonthly->expense_id;
            $cashMonthly->delete();
            
        }
         $otherPhead = $this->expenseRepo->find($idCompra);
        $request->merge(["montoPagado"=>floatval($otherPhead->montoPagado)-floatval($request->input("monto"))]);
        $request->merge(["Saldo"=>floatval($otherPhead->Saldo)+floatval($request->input("monto"))]);
        $request->merge(["fecha"=>$otherPhead->fecha]);
        $request->merge(["numeroDocumento"=>$otherPhead->numeroDocumento]);
        $request->merge(["proveedor"=>$otherPhead->proveedor]);
        $request->merge(["ruc"=>$otherPhead->ruc]);
        $compras = new ExpenseManager($otherPhead,$request->only("fecha","numeroDocumento","proveedor","ruc","montoPagado","Saldo"));
        $compras->save();
         
        \DB::commit();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
        
    }
    public function find($id)
    {
        $otherPhead = $this->otherPheadRepo->find($id);
        return response()->json($otherPhead);
    }
    public function find2($id)
    {
        $expense = $this->expenseRepo->find($id);
        return response()->json($expense);
    }
    public function traendoDetGastos($q){
        $detExpense = $this->detExpenseRepo->traendoDetGastos($q);
        return response()->json($detExpense);
    }
     public function datos($id)    
    {
        $otherPdetail = $this->otherPdetailRepo->datos($id);
        return response()->json($otherPdetail);
    }
    public function edit(Request $request)
    {
        \DB::beginTransaction();
        $otherPhead = $this->otherPheadRepo->find($request->id);
        $var=$request->detalles;
        //var_dump($brand);
        //die(); 
        $manager = new OtherPheadManager($otherPhead,$request->all());
        $manager->save();
        $idHead=$otherPhead->id;
        $otherPdetail = $this->otherPdetailRepo->datos($request->id);
        foreach ($otherPdetail as $object) {
            $otherPdetail= $this->otherPdetailRepo->find($object["id"]);
            $otherPdetail->delete();
        }
        foreach ($var as $object) {
            $object['otherPhead_id']=$idHead;
            $otherPdetailRepo = new OtherPdetailRepo;
            $otherPdetail=new OtherPdetailManager($otherPdetailRepo->getModel(),$object);
            $otherPdetail->save();
        }
        \DB::commit();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
    }
    public function edit2(Request $request)
    {
        \DB::beginTransaction();
        $expense = $this->expenseRepo->find($request->id);
        $var=$request->detalles;
        //var_dump($brand);
        //die(); 
        $manager = new ExpenseManager($expense,$request->all());
        $manager->save();
        $idHead=$expense->id;
        $detExpense = $this->detExpenseRepo->traendoDetGastos($request->id);
        foreach ($detExpense as $object) {
            $detExpense= $this->detExpenseRepo->find($object["id"]);
            $detExpense->delete();
        }
        foreach ($var as $object) {
            $object['expense_id']=$idHead;
//
            $detExpenseRepo = new DetExpenseRepo;
            $otherPdetail=new DetExpenseManager($detExpenseRepo->getModel(),$object);
            $otherPdetail->save();
        }
        \DB::commit();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
    }

    public function destroy(Request $request)
    {
        $otherPdetail = $this->otherPdetailRepo->datos($request->id);
        foreach ($otherPdetail as $object) {
            $otherPdetail= $this->otherPdetailRepo->find($object["id"]);
            $otherPdetail->delete();
        }
        $otherPhea= $this->otherPheadRepo->find($request->id);
        $otherPhea->delete();
        
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
    }
     public function destroy2(Request $request)
    {
        $otherPdetail = $this->detExpenseRepo->traendoDetGastos($request->id);
        foreach ($otherPdetail as $object) {
            $otherPdetail= $this->detExpenseRepo->find($object["id"]);
            $otherPdetail->delete();
        }
        $otherPhea= $this->expenseRepo->find($request->id);
        $otherPhea->delete();
        
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true]);
    }
    public function show()
    {
        return View('otherPheads.show');
    }
    public function show2()
    {
        return View('otherPheads.show2');
    }
    public function form_editGasto()
    {
        return View('otherPheads.form_editGasto');
    }
    public function form_balance()
    {
        return View('otherPheads.form_balance');
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $brands = $this->otherPheadRepo->search($q);

        return response()->json($brands);
    }
    public function validaBrandname($text){
        
        $brands = $this->brandRepo->validarNoRepit($text);

        return response()->json($brands);
    }
}