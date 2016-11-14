<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\practicaRepo;
use Salesfly\Salesfly\Managers\practicaManager;

class PracticasController extends Controller {

    protected $practicaRepo;

    public function __construct(practicaRepo $practicaRepo)
    {
        $this->practicaRepo = $practicaRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    public function index()
    {
        //return "Hola mundo";
        return View('practicas.index');
    }

    public function all()
    {
        $practicas = $this->practicaRepo->all();
        return response()->json($practicas);
        //var_dump($practicas);
    }

    public function paginatep(){
        $practicas = $this->practicaRepo->paginate(5);
        return response()->json($practicas);
    }


    public function form_create()
    {
        return View('practicas.form_create');
    }

    public function form_edit()
    {
        return View('practicas.form_edit');
    }

    public function create(Request $request)
    {
        $practica = $this->practicaRepo->getModel();

        $manager = new practicaManager($practica,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$practica->nombre]);
       //return $request.nombre;
    }

    public function find($id)
    {
        $practica = $this->practicaRepo->find($id);
        return response()->json($practica);
    }

    public function edit(Request $request)
    {
        $practica = $this->practicaRepo->find($request->id);
        //var_dump($request->except('fechaNac'));
        //die();
        //////$manager = new practicaManager($practica,$request->except('fechaNac'));
        ///////$manager->save();
       /////if($this->practicaRepo->validateDate(substr($request->input('fechaNac'),0,10))){
            //$practica->fechaNac = date("Y-m-d", strtotime($request->input('fechaNac')));
          /////// $practica->fechaNac = substr($request->input('fechaNac'),0,10);
           
        //////}
        $manager = new practicaManager($practica,$request->all());
        $manager->save();
        //Event::fire('update.practica',$practica->all());
        return response()->json(['estado'=>true, 'nombre'=>$practica->nombre]);
    }

    public function destroy(Request $request)
    {
        $practica= $this->practicaRepo->find($request->id);
        $practica->delete();
        //Event::fire('update.practica',$practica->all());
        return response()->json(['estado'=>true, 'nombre'=>$practica->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $practicas = $this->practicaRepo->search($q);

        return response()->json($practicas);
    }
}