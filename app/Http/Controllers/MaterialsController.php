<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\MaterialRepo;
use Salesfly\Salesfly\Managers\MaterialManager;

class MaterialsController extends Controller {

    protected $materialRepo;

    public function __construct(MaterialRepo $materialRepo)
    {
        $this->materialRepo = $materialRepo;
    }

    public function index()
    {
        return View('materials.index');
    }

    public function all()
    {
        $materials = $this->materialRepo->paginate(15);
        return response()->json($materials);
        //var_dump($materials);
    }

    public function paginatep(){
        $materials = $this->materialRepo->paginate(15);
        return response()->json($materials);
    }


    public function form_create()
    {
        return View('materials.form_create');
    }

    public function form_edit()
    {
        return View('materials.form_edit');
    }

    public function create(Request $request)
    {
        $materials = $this->materialRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new MaterialManager($materials,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.material',$material->all());

        return response()->json(['estado'=>true, 'nombre'=>$materials->nombre]);
    }

    public function find($id)
    {
        $material = $this->materialRepo->find($id);
        return response()->json($material);
    }

    public function edit(Request $request)
    {
        $material = $this->materialRepo->find($request->id);
        //var_dump($material);
        //die(); 
        $manager = new MaterialManager($material,$request->all());
        $manager->save();

        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }

    public function destroy(Request $request)
    {
        $material= $this->materialRepo->find($request->id);
        $material->delete();
        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'nombre'=>$material->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $materials = $this->materialRepo->search($q);

        return response()->json($materials);
    }
}