<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\WarehouseRepo;
use Salesfly\Salesfly\Managers\WarehouseManager;

class WarehousesController extends Controller {

    protected $warehouseRepo;

    public function __construct(WarehouseRepo $warehouseRepo)
    {
        $this->warehouseRepo = $warehouseRepo;
    }

    public function index()
    {

        return View('warehouses.index');
    }

    public function all()
    {
        $warehouses = $this->warehouseRepo->all();
        return response()->json($warehouses);
        //var_dump($warehouses);
    }

    public function paginatep(){ //->with(['store'])
        $warehouses = $this->warehouseRepo->paginaterepo(15);
        //$warehouses = $this->warehouseRepo->with(['store'])->paginate(15);
        return response()->json($warehouses);
    }


    public function form_create()
    {
        return View('warehouses.form_create');
    }

    public function form_edit()
    {
        return View('warehouses.form_edit');
    }
 
    public function create(Request $request)
    {
        $warehouses = $this->warehouseRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new WarehouseManager($warehouses,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.warehouse',$warehouse->all());

        return response()->json(['estado'=>true, 'nombre'=>$warehouses->nombre]);
    }

    public function find($id)
    {
        $warehouse = $this->warehouseRepo->find($id);
        return response()->json($warehouse);
    }

    public function edit(Request $request)
    {
        $warehouse = $this->warehouseRepo->find($request->id);
        //var_dump($warehouse);
        //die(); 
        $manager = new WarehouseManager($warehouse,$request->all());
        $manager->save();

        //Event::fire('update.warehouse',$warehouse->all());
        return response()->json(['estado'=>true, 'nombre'=>$warehouse->nombre]);
    }

    public function destroy(Request $request)
    {
        $warehouse= $this->warehouseRepo->find($request->id);
        $warehouse->delete();
        //Event::fire('update.warehouse',$warehouse->all());
        return response()->json(['estado'=>true, 'nombre'=>$warehouse->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $warehouses = $this->warehouseRepo->search($q);

        return response()->json($warehouses);
    }
    public function searchWarehouse($q,$id)
    {
        //$q = Input::get('q');
        $warehouses = $this->warehouseRepo->searchWarehouse($q,$id);

        return response()->json($warehouses);
        //return "Hola";
    }
    
    public function selectWarehouses(){
        $warehouses = $this->warehouseRepo->traerAlmacenporUsuario();
        return response()->json($warehouses); 
    }
    public function searchWere($q)
    {
        //$q = Input::get('q');
        $warehouses = $this->warehouseRepo->searchWere($q);

        return response()->json($warehouses);
    }

}