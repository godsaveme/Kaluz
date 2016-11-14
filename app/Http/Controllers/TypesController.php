<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\TypeRepo;
use Salesfly\Salesfly\Managers\TypeManager;

class TypesController extends Controller {

    protected $typeRepo;

    public function __construct(TypeRepo $typeRepo)
    {
        $this->typeRepo = $typeRepo;
    }

    public function index()
    {
        return View('types.index');
    }

    public function all()
    {
        $types = $this->typeRepo->paginate(15);
        return response()->json($types);
        //var_dump($types);
    }

    public function paginatep(){
        $types = $this->typeRepo->paginate(15);
        return response()->json($types);
    }


    public function form_create()
    {
        return View('types.form_create');
    }

    public function form_edit()
    {
        return View('types.form_edit');
    }

    public function create(Request $request)
    {

        $Ttype = $this->typeRepo->getModel();
        
        $manager = new TypeManager($Ttype,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.Ttype',$Ttype->all());

        return response()->json(['estado'=>true, 'nombre'=>$Ttype->nombre]);
    }

    public function find($id)
    {
        $Ttype = $this->typeRepo->find($id);
        return response()->json($Ttype);
    }

    public function edit(Request $request)
    {
        $Ttype = $this->typeRepo->find($request->id);
        //var_dump($Ttype);
        //die(); 
        $manager = new TypeManager($Ttype,$request->all());
        $manager->save();

        //Event::fire('update.Ttype',$Ttype->all());
        return response()->json(['estado'=>true, 'nombre'=>$Ttype->nombre]);
    }

    public function destroy(Request $request)
    {
        $Ttype= $this->typeRepo->find($request->id);
        $Ttype->delete();
        //Event::fire('update.Ttype',$Ttype->all());
        return response()->json(['estado'=>true, 'nombre'=>$Ttype->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $types = $this->typeRepo->search($q);

        return response()->json($types);
    }

    public function searchType($q)
    {
        //$q = Input::get('q');
        $types = $this->typeRepo->searchType($q);

        return response()->json($types);
    }
}