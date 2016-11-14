<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PersonRepo;
use Salesfly\Salesfly\Managers\PersonManager;

class PersonsController extends Controller {

    protected $personRepo;

    public function __construct(PersonRepo $personRepo)
    {
        $this->personRepo = $personRepo;
    }

    public function index()
    {
        return View('persons.index');
    }

    public function all()
    {
        $persons = $this->personRepo->paginate(15);
        return response()->json($persons);
        //var_dump($persons);
    }

    public function paginatep(){
        $persons = $this->personRepo->paginate(15);
        return response()->json($persons);
    }


    public function form_create()
    {
        return View('persons.form_create');
    }

    public function form_edit()
    {
        return View('persons.form_edit');
    }

    public function create(Request $request)
    {
        $person = $this->personRepo->getModel();
        var_dump($request->all());
        die();
        $manager = new PersonManager($person,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.person',$person->all());

        return response()->json(['estado'=>true, 'nombre'=>$person->nombres]);
    }

    public function find($id)
    {
        $person = $this->personRepo->find($id);
        return response()->json($person);
    }

    public function edit(Request $request)
    {
        $person = $this->personRepo->find($request->id);
        //var_dump($person);
        //die(); 
        $manager = new PersonManager($person,$request->all());
        $manager->save();

        //Event::fire('update.person',$person->all());
        return response()->json(['estado'=>true, 'nombre'=>$person->nombre]);
    }

    public function destroy(Request $request)
    {
        $person= $this->personRepo->find($request->id);
        $person->delete();
        //Event::fire('update.person',$person->all());
        return response()->json(['estado'=>true, 'nombre'=>$person->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $persons = $this->personRepo->search($q);

        return response()->json($persons);
    }
}