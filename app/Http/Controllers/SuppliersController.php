<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SupplierRepo;
use Salesfly\Salesfly\Managers\SupplierManager;

class SuppliersController extends Controller {

    protected $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function index()
    {
        return View('suppliers.index');
    }

    public function all()
    {
        $suppliers = $this->supplierRepo->paginate(15);
        return response()->json($suppliers);
    }
    public function deudas(){
       
        $suppliers = $this->supplierRepo->deudas();
        return response()->json($suppliers);
    }
    public function paginatep(){
        $suppliers = $this->supplierRepo->paginate(15);
        return response()->json($suppliers);
    }


    public function form_create()
    {
        return View('suppliers.form_create');
    }

    public function form_edit()
    {
        return View('suppliers.form_edit');
    }

    public function create(Request $request)
    {
        $supplier = $this->supplierRepo->getModel();
        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('suppliers')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }
       
        $manager = new SupplierManager($supplier,$request->except('fechanac'));
        
        $manager->save();
        if($this->supplierRepo->validateDate(substr($request->input('fechanac'),0,10))){
            $supplier->fechanac = substr($request->input('fechanac'),0,10);
        }else{
            $supplier->fechanac = null;
        }

        $supplier->save();

        return response()->json(['estado'=>true, 'nombres'=>$supplier->nombres]);
    }

    public function find($id)
    {
        $supplier = $this->supplierRepo->find($id);
        return response()->json($supplier);
    }

    public function edit(Request $request)
    {
        $supplier = $this->supplierRepo->find($request->id);
        //===================autogenerado========================//

        if($request->input('autogenerado') === true) {
            $codigo = \DB::table('suppliers')->max('codigo');
            if (!empty($codigo)) {
                $codigo = $codigo + 1;
            } else {
                $codigo = 1; //inicializar el sku;
            }
            $request->merge(array('codigo' => $codigo));
        }else{

        }
        $manager = new SupplierManager($supplier,$request->except('fechanac'));
        $manager->save();
        if($this->supplierRepo->validateDate(substr($request->input('fechanac'),0,10))){
            $supplier->fechanac = substr($request->input('fechanac'),0,10);
            $supplier->save();
        }
        return response()->json(['estado'=>true, 'nombre'=>$supplier->nombre]);
    }

    public function destroy(Request $request)
    {
        $supplier= $this->supplierRepo->find($request->id);
        $supplier->delete();
        return response()->json(['estado'=>true, 'nombre'=>$supplier->nombres]);
    }

    public function search($q)
    {
        $suppliers = $this->supplierRepo->search($q);

        return response()->json($suppliers);
    }
     public function selectSupliers(){
        $suppliers = $this->supplierRepo->all();
        return response()->json($suppliers);
    }

}