<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Salesfly\Salesfly\Entities\Store;

use Salesfly\Salesfly\Repositories\AtributRepo;
use Salesfly\Salesfly\Managers\AtributManager;

class AtributesController extends Controller {

    protected $atributRepo;

    public function __construct(AtributRepo $atributRepo)
    {
        $this->atributRepo = $atributRepo;
        //$this->middleware('auth');
    }
    public function selest(){
        //$stores = Store::all();
        $stores = alumno::all();
        return response()->json($stores);
    }
    public function selectNumber($id,$tama){
        $atributes = $this->atributRepo->eligirNumero($id,$tama);
        return response()->json($atributes);
    }
    public function index()
    {

        return View('atributes.index');
    }

    public function all()
    {
        $atributes = $this->atributRepo->paginate(15);
        return response()->json($atributes);
        //var_dump($atributes);
    }

    public function paginatep(){
        $atributes = $this->atributRepo->paginate(15);
        return response()->json($atributes);
    }


    public function form_create()
    {
        return View('atributes.form_create');
    }

    public function form_edit()
    {
        return View('atributes.form_edit');
    }

    public function create(Request $request)
    {
        $atribut = $this->atributRepo->getModel();
        //var_dump($request->all());
        //die();
        //print($atribut); die();
        $manager = new AtributManager($atribut,$request->all());
        //print_r($manager->entity->apellidos); die();
        //print_r($atribut->nombres); die();
        $manager->save();
        

        return response()->json(['estado'=>true, 'nombres'=>$atribut->nombre]);
    }

    public function find($id)
    {
        $atribut = $this->atributRepo->find($id);
        return response()->json($atribut);
    }

    public function edit(Request $request)
    {
        $atribut = $this->atributRepo->find($request->id);
        //var_dump($request->except('fechaNac'));
        //die();
        $manager = new AtributManager($atribut,$request->all());
        $manager->save();
        

        //Event::fire('update.atribut',$atribut->all());
        return response()->json(['estado'=>true, 'nombre'=>$atribut->nombre]);
    }

    public function destroy(Request $request)
    {
        $atribut= $this->atributRepo->find($request->id);
        $atribut->delete();
        //Event::fire('update.atribut',$atribut->all());
        return response()->json(['estado'=>true, 'nombre'=>$atribut->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $atributes = $this->atributRepo->search($q);

        return response()->json($atributes);
    }
}