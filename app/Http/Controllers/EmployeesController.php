<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EmployeeRepo;
use Salesfly\Salesfly\Managers\EmployeeManager;

use Intervention\Image\Facades\Image;

class EmployeesController extends Controller {

    protected $employeeRepo;

    public function __construct(EmployeeRepo $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function index()
    {
        return View('employees.index');
    }

    public function all()
    {
        $employees = $this->employeeRepo->paginate(15);
        return response()->json($employees);
        //var_dump($employees);
    }

    public function paginatep(){
        $employees = $this->employeeRepo->paginate(15);
        return response()->json($employees);
    }


    public function form_create()
    {
        return View('employees.form_create');
    }

    public function form_edit()
    {
        return View('employees.form_edit');
    }

    public function create(Request $request)
    {
        //var_dump($request->all()); die();
        $employee = $this->employeeRepo->getModel();

        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('employees')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }

        //================fin auto==============================//
       
        $manager = new EmployeeManager($employee,$request->except('fechanac','imagen'));
        $manager->save();
        //------------------------------------------------

        if($request->has('imagen') and substr($request->input('imagen'),5,5) === 'image'){
            $imagen = $request->input('imagen');
            $mime = $this->get_string_between($imagen,'/',';');
            $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen));
            Image::make($imagen)->resize(200,200)->save('images/employees/'.$employee->id.'.'.$mime);
            $employee->imagen='/images/employees/'.$employee->id.'.'.$mime;
            $employee->save();
        }else{
            $employee->imagen='/images/employees/default.jpg';
            $employee->save();
        }
        //-------------------------------------------------
        
       
        if($this->employeeRepo->validateDate(substr($request->input('fechanac'),0,10))){
            $employee->fechanac = substr($request->input('fechanac'),0,10);
        }else{
            $employee->fechanac = null;
        }

        $employee->save();

        return response()->json(['estado'=>true, 'nombres'=>$employee->nombres]);
    }

    public function find($id)
    {
        $employee = $this->employeeRepo->find($id);
        return response()->json($employee);
    }

    public function edit(Request $request)
    {
       $employee = $this->employeeRepo->find($request->id);
       //var_dump($employee->all());die();
        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('employees')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }

        //================fin auto==============================//
        $manager = new EmployeeManager($employee,$request->except('fechanac','imagen'));
        $manager->save();
        //------------------------------------------------
        
        if($request->has('imagen') and substr($request->input('imagen'),5,5) === 'image'){
            $imagen = $request->input('imagen');
            $mime = $this->get_string_between($imagen,'/',';');
            $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen));
            Image::make($imagen)->resize(200,200)->save('images/employees/'.$employee->id.'.'.$mime);
            $employee->imagen='/images/employees/'.$employee->id.'.'.$mime;
            $employee->save();
        }
        //-------------------------------------------------
        
       
        if($this->employeeRepo->validateDate(substr($request->input('fechanac'),0,10))){
            $employee->fechanac = substr($request->input('fechanac'),0,10);
        }else{
            $employee->fechanac = null;
        }

        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('employees')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }

        //================fin auto==============================//

        $employee->save();

        return response()->json(['estado'=>true, 'nombres'=>$employee->nombres]);
    }

    public function destroy(Request $request)
    {
        $employee= $this->employeeRepo->find($request->id);
        $employee->delete();
        //Event::fire('update.employee',$employee->all());
        return response()->json(['estado'=>true, 'nombre'=>$employee->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $employees = $this->employeeRepo->search($q);

        return response()->json($employees);
    }
    public function searchVenta($q)
    {
        //$q = Input::get('q');
        $employees = $this->employeeRepo->searchVenta($q);

        return response()->json($employees);
    }

    public function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
}