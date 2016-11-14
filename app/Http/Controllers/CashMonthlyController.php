<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CashMonthlyRepo;
use Salesfly\Salesfly\Managers\CashMonthlyManager;

class CashMonthlyController extends Controller {

    protected $CashMonthlyRepo;

    public function __construct(CashMonthlyRepo $CashMonthlyRepo)
    {
        $this->CashMonthlyRepo = $CashMonthlyRepo;
    }


    public function index()
    {
        return View('cashMonthlys.index');
        //return 'hola';
    }

    public function all()
    {
        $cashMonthlys = $this->CashMonthlyRepo->paginate(15);
        return response()->json($cashMonthlys);
        //var_dump($materials);
    }

    public function paginatep(){
        
        $cashMonthlys = $this->CashMonthlyRepo->paginate(15);
        return response()->json($cashMonthlys);
    }


    public function form_create()
    {
        return View('cashMonthlys.form_create');
    }

    public function form_edit()
    {
        return View('cashMonthlys.form_edit');
    }
    
    public function create(Request $request)
    {
        //var_dump($request->all());
        //die();
        $cashMonthlys = $this->CashMonthlyRepo->getModel();

        $manager = new CashMonthlyManager($cashMonthlys,$request->all());
        $manager->save();
/*
        if($this->CashMonthlyRepo->validateDate(substr($request->input('fecha'),0,19))){
            //$customer->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
            $cashMonthlys->fecha = substr($request->input('fecha'),0,19);
            //var_dump($request->input('fecha'));
            //die();
        }else{
            $cashMonthlys->fecha = null;
        }

        $cashMonthlys->save();
        */

        return response()->json(['estado'=>true, 'descripcion'=>$cashMonthlys->descripcion]);
    }

    public function find($id)
    {
        $material = $this->CashMonthlyRepo->find($id)->paginate(15);
        return response()->json($material);
    }

    public function edit(Request $request)
    {
        $material = $this->CashMonthlyRepo->find($request->id);
        //var_dump($material);
        //die(); 
        $manager = new CashMonthlyManager($material,$request->all());
        $manager->save();

        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }

    public function destroy(Request $request)
    {
        $material= $this->CashMonthlyRepo->find($request->id);
        $material->delete();
        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }

    public function search($m,$a,$c)
    {
        //return substr($q, 0,1);
        //return substr($q, -1);

        $cashMonthlys = $this->CashMonthlyRepo->search($m,$a,$c);

        return response()->json($cashMonthlys);
        //return $m+$a+$c;
    }
    public function searchMonto($m,$a,$c)
    {
        //return substr($q, 0,1);
        //return substr($q, -1);

        $cashMonthlys = $this->CashMonthlyRepo->searchMonto($m,$a,$c);

        return response()->json($cashMonthlys);
        //return $m+$a+$c;
    }

    public function reporteCajaMensual($fech1,$fech2,$concep){
        if($concep==0){
            $concep='';
        }
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_CajaMensual';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/CajaMensual.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['fechaini' => $fech1,'fechafin'=>$fech2,'concepto'=>$concep],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_CajaMensual.'.$ext;
    }
}