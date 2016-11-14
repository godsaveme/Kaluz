<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CashRepo;
use Salesfly\Salesfly\Managers\CashManager;
use Salesfly\Salesfly\Entities\Cash;

class CashesController extends Controller
{
    protected $cashRepo;

    public function __construct(CashRepo $cashRepo)
    {
        $this->cashRepo = $cashRepo;
    }
    public function ReportCashes($fecha1,$fecha2){
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReporteCajas';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReporteCajas.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','fechaini'=>$fecha1,'fechafin'=>$fecha2],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReporteCajas.'.$ext;
    }
    public function Reportedetcash($caja_id){
       
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_ReportDetCash';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/ReportDetCash.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['SUBREPORT_DIR'=> public_path() . '/report/','cash_id'=>$caja_id],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_ReportDetCash.'.$ext;
    }
    public function all()
    {
        $cashes = $this->cashRepo->paginate(15);
        return response()->json($cashes);
        //var_dump($materials);
    }

    public function searchOpenCashxCashHeader(Request $request){
        $cashes =Cash::where('cashHeader_id','=', $request->input(0))
            ->where('estado','=',1)
            //with(['customer','employee'])
            ->first();
        //return $cashes;
        return response()->json($cashes);
    }

    public function cajas_for_user(){
        $cash=$this->cashRepo->searchuserincaja(auth()->user()->id);
        return response()->json($cash);
    }
    public function cajas_for_user1($id){
        $cash=$this->cashRepo->searchuserincaja1($id,auth()->user()->id);
        return response()->json($cash);
    }

    public function paginatep(){
        $cashes = $this->cashRepo->paginate2(15);
        return response()->json($cashes);
    }

    public function find($id)
    {
        $cash = $this->cashRepo->find($id);
        return response()->json($cash);
    }

    public function search($q)
    {
        $cashes = $this->cashRepo->search($q);

        return response()->json($cashes);
    }

    public function index()
    {
        return View('cashes.index');
    }

    public function form_create()
    {
        return View('cashes.form_create');
    }
    public function form_edit()
    {
        return View('cashes.form_edit');
    }
    public function create(Request $request)
    {
        //var_dump($request->cashHeader_id);
        //die();

        $cash1 = Cash::where('cashHeader_id',$request->cashHeader_id)
                        ->where('estado','1')
                        ->first();

        $cash2 = Cash::where('user_id',auth()->user()->id)
                        ->where('estado','1')
                        ->first();
        //var_dump(count($cash1));
        //var_dump(count($cash2));
        //die();
        if(count($cash1) > 0 or count($cash2) > 0){
            return response()->json(['estado'=>false]);
        }else {
            $cash = $this->cashRepo->getModel();
            $request->merge(['user_id' => auth()->user()->id]);
            $manager = new CashManager($cash, $request->all());
            $manager->save();
            return response()->json(['estado'=>true, 'nombre'=>$cash->fechaInicio]);
        }

    }
    public function edit(Request $request)
    {
        $cash = $this->cashRepo->find($request->id);

        $manager = new CashManager($cash,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$cash->nombre]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
