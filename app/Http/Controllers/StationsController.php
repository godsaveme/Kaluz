<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\StationRepo;
use Salesfly\Salesfly\Managers\StationManager;

class StationsController extends Controller {

    protected $stationRepo;

    public function __construct(StationRepo $stationRepo)
    {
        $this->stationRepo = $stationRepo;
    }
    public function validastationname($text){
        
        $brands = $this->stationRepo->validarNoRepit($text);

        return response()->json($brands);
    }

    public function index()
    {
        return View('stations.index');
    }

    public function all()
    {
        $stations = $this->stationRepo->paginate(15);
        return response()->json($stations);
        //var_dump($stations);
    }

    public function paginatep(){
        $stations = $this->stationRepo->paginate(15);
        return response()->json($stations);
    }


    public function form_create()
    {
        return View('stations.form_create');
    }

    public function form_edit()
    {
        return View('stations.form_edit');
    }

    public function create(Request $request)
    {
        $stations = $this->stationRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new StationManager($stations,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.station',$station->all());

        return response()->json(['estado'=>true, 'nombre'=>$stations->nombre]);
    }

    public function find($id)
    {
        $station = $this->stationRepo->find($id);
        return response()->json($station);
    }

    public function edit(Request $request)
    {
        $station = $this->stationRepo->find($request->id);

        $manager = new StationManager($station,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function destroy(Request $request)
    {
        $station= $this->stationRepo->find($request->id);
        $station->delete();
        //Event::fire('update.station',$station->all());
        return response()->json(['estado'=>true, 'nombre'=>$station->nombre]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $stations = $this->stationRepo->search($q);

        return response()->json($stations);
    }
}