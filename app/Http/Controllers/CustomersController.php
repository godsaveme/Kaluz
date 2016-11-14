<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CustomerRepo;
use Salesfly\Salesfly\Managers\CustomerManager;

class CustomersController extends Controller {

    protected $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    public function index()
    {

        return View('customers.index');
    }

    public function all()
    {
        $customers = $this->customerRepo->paginate(15);
        return response()->json($customers);
        //var_dump($customers);
    }

    public function paginatep(){
        $customers = $this->customerRepo->paginate(15);
        return response()->json($customers);
    }
    public function ComprobarDatos($datos){
         $customers = $this->customerRepo->ComprobarDatos($datos);
        return response()->json($customers);
    }

    public function form_create()
    {
        return View('customers.form_create');
    }

    public function form_edit()
    {
        return View('customers.form_edit');
    }

    public function create(Request $request)
    {
        $customer = $this->customerRepo->getModel();

        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('customers')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }

        //================fin auto==============================//
        //var_dump($request->all());
        //die();
        //print($customer); die();
        $manager = new CustomerManager($customer,$request->except('fechaNac'));
        //print_r($manager->entity->apellidos); die();
        //print_r($customer->nombres); die();
        $manager->save();
        //if (!empty($request->input('fechaNac'))) {
        //    $customer->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
        //}
        //print_r(substr($request->input('fechaNac'),0,10)); die();
        if($this->customerRepo->validateDate(substr($request->input('fechaNac'),0,10))){
            //$customer->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
            $customer->fechaNac = substr($request->input('fechaNac'),0,10);
        }else{
            $customer->fechaNac = null;
        }

        $customer->save();
        //print_r($request->all()); die();
        //print_r($customer->nombres); die();
        //Event::fire('update.customer',$customer->all());

        return response()->json(['estado'=>true, 'nombres'=>$customer->nombres."-".$customer->apellidos."-".$customer->empresa, 'id'=>$customer->id]);
    }

    public function find($id)
    {
        $customer = $this->customerRepo->find($id);
        return response()->json($customer);
    }

    public function edit(Request $request)
    {
        $customer = $this->customerRepo->find($request->id);
        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('customers')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }

        //================fin auto==============================//
        //var_dump($request->except('fechaNac'));
        //die();
        $manager = new CustomerManager($customer,$request->except('fechaNac'));
        $manager->save();
        if($this->customerRepo->validateDate(substr($request->input('fechaNac'),0,10))){
            //$customer->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
            $customer->fechaNac = substr($request->input('fechaNac'),0,10);
            $customer->save();
        }

        //Event::fire('update.customer',$customer->all());
        return response()->json(['estado'=>true, 'nombre'=>$customer->nombre]);
    }

    public function destroy(Request $request)
    {
        $customer= $this->customerRepo->find($request->id);
        $customer->delete();
        //Event::fire('update.customer',$customer->all());
        return response()->json(['estado'=>true, 'nombre'=>$customer->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $customers = $this->customerRepo->search($q);

        return response()->json($customers);
    }

    public function searchVenta($q)
    {
        //$q = Input::get('q');
        $customers = $this->customerRepo->searchVenta($q);

        return response()->json($customers);
    }
}