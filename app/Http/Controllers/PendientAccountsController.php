<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;

class PendientAccountsController extends Controller
{
    protected $pendientAccountRepo;

    public function __construct(DetCashRepo $detCashRepo,CashRepo $cashRepo,PendientAccountRepo $pendientAccountRepo)
    {
        $this->pendientAccountRepo = $pendientAccountRepo;
        $this->detCashRepo=$detCashRepo;
        $this->cashRepo=$cashRepo;
    }

    

    public function paginatep(){
        $pendientAccount = $this->pendientAccountRepo->paginar();
        return response()->json($pendientAccount);
    }

    
    public function search($q)
    {
        $pendientAccount = $this->cashRepo->search($q);

        return response()->json($pendientAccount);
    }


    public function create(Request $request)
    {
        $cash = $this->pendientAccountRepo->getModel();

        $manager = new CashManager($cash,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$cash->fechaInicio]);
    }
    public function edit(Request $request)
    {
        \DB::beginTransaction();
        $pendientAccount = $this->pendientAccountRepo->find($request->id);
        $cash =$this->cashRepo->find($request->input('cash_id'));
        $detCash=$this->detCashRepo->getModel();
        $manager = new PendientAccountManager($pendientAccount,$request->except("fecha"));
        $manager->save();
        if(!empty( $cash)){
        //===============================================================
        $request->merge(["montoMovimientoTarjeta"=>0]);
        $request->merge(["montoMovimientoEfectivo"=>$request->input("nuevoSaldo")]);
        $request->merge(["estado"=>1]);
        $request->merge(["observacion"=>"ingreso por pago de saldos anteriores"]);
        $request->merge(["cashMotive_id"=>5]);
        $request->merge(["montoCaja"=>$cash->montoBruto]);
        $request->merge(["montoFinal"=>floatval($cash->montoBruto)+floatval($request->input("nuevoSaldo"))]);
        $detcash = new DetCashManager($detCash,$request->all());
        $detcash->save();
        $var['detCash_id']=$detCash->id;
             $request->merge(["gastos"=>$cash->gastos]);
             $request->merge(['fechaInicio'=>$cash->fechaInicio]);
             $request->merge(['fechaFin'=>$cash->fechaFin]);
             $request->merge(['montoInicial'=>$cash->montoInicial]);
             $request->merge(['ingresos'=>floatval($cash->ingresos)+floatval($request->input("nuevoSaldo"))]);
             $request->merge(['montoBruto'=>floatval($cash->montoBruto)+floatval($request->input("nuevoSaldo"))]);
             $request->merge(['montoReal'=>$cash->montoReal]);
             $request->merge(['descuadre'=>$cash->descuadre]);
             $request->merge(['notas'=>$cash->notas]);
             $request->merge(['cashHeader_id'=>$cash->cashHeader_id]);
        $cashr = new CashManager($cash,$request->all());
        $cashr->save();
         \DB::commit();
    }
        //===============================================================
        return response()->json(['estado'=>true]);
    }
    public function verSaldosTotales($id){
        $pendientAccount = $this->pendientAccountRepo->verSaldosTotales($id);
        return response()->json($pendientAccount);
    }

    
}