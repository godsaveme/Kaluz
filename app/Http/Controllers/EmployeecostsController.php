<?php
namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\EmployeecostRepo;
use Salesfly\Salesfly\Managers\EmployeecostManager;

class EmployeecostsController extends Controller {

    protected $employeecostRepo;

    public function __construct(EmployeecostRepo $employeecostRepo)
    {
        $this->employeecostRepo = $employeecostRepo;
    }

    public function index()
    {
        return View('employeecosts.index');
    }

    public function all()
    {
        $employeecosts = $this->employeecostRepo->paginate(15);
        return response()->json($employeecosts);
        //var_dump($employeecosts);
    }
    public function mostrarCostos($id){
        $employeecost=$this->employeecostRepo->mostrarCostos($id);
        return response()->json($employeecost);
    }

    public function paginatep(){
        $employeecosts = $this->employeecostRepo->paginate(15);
        return response()->json($employeecosts);
    }

    public function form_create()
    {
        return View('employeecosts.form_create');
    }

    public function form_edit()
    {
        return View('employeecosts.form_edit');
    }

    public function create(Request $request)
    {
        $employeecosts = $this->employeecostRepo->getModel();
        $manager = new EmployeecostManager($employeecosts,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$employeecosts->SueldoFijo]);
    }

    public function find($id)
    {
        $brand = $this->employeecostRepo->find($id);
        return response()->json($brand);
    }

    public function edit(Request $request)
    {
        $brand = $this->employeecostRepo->find($request->id); 
        $manager = new EmployeecostManager($brand,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$brand->SueldoFijo]);
    }

    public function destroy(Request $request)
    {
        $brand= $this->employeecostRepo->find($request->id);
        $brand->delete();
        return response()->json(['estado'=>true, 'nombre'=>$brand->SueldoFijo]);
    }

    public function search($q)
    {
        $employecosts = $this->employeecostRepo->search($q);

        return response()->json($employecosts);
    }
}