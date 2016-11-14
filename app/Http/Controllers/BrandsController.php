<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\BrandRepo;
use Salesfly\Salesfly\Managers\BrandManager;

class BrandsController extends Controller {

    protected $brandRepo;

    public function __construct(BrandRepo $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function index()
    {
        return View('brands.index');
    }

    public function all()
    {
        $brands = $this->brandRepo->paginate(15);
        return response()->json($brands);
        //var_dump($brands);
    }

    public function paginatep(){
        $brands = $this->brandRepo->paginate(15);
        return response()->json($brands);
    }


    public function form_create()
    {
        return View('brands.form_create');
    }

    public function form_edit()
    {
        return View('brands.form_edit');
    }

    public function create(Request $request)
    {
        $brands = $this->brandRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new BrandManager($brands,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.brand',$brand->all());

        return response()->json(['estado'=>true, 'nombre'=>$brands->nombre]);
    }

    public function find($id)
    {
        $brand = $this->brandRepo->find($id);
        return response()->json($brand);
    }

    public function edit(Request $request)
    {
        $brand = $this->brandRepo->find($request->id);
        //var_dump($brand);
        //die(); 
        $manager = new BrandManager($brand,$request->all());
        $manager->save();

        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$brand->nombre]);
    }

    public function destroy(Request $request)
    {
        $brand= $this->brandRepo->find($request->id);
        $brand->delete();
        //Event::fire('update.brand',$brand->all());
        return response()->json(['estado'=>true, 'nombre'=>$brand->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $brands = $this->brandRepo->search($q);

        return response()->json($brands);
    }
    public function validaBrandname($text){
        
        $brands = $this->brandRepo->validarNoRepit($text);

        return response()->json($brands);
    }
}