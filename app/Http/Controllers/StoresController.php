<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\StoreRepo;
use Salesfly\Salesfly\Managers\StoreManager;

class StoresController extends Controller {

    protected $storeRepo;

    public function __construct(StoreRepo $storeRepo)
    {
        $this->storeRepo = $storeRepo;
    }

    public function index()
    {
        return View('stores.index');
    }

    public function all()
    {
        $stores = $this->storeRepo->paginate(15);
        return response()->json($stores);
        //var_dump($stores);
    }

    public function paginatep(){
        $stores = $this->storeRepo->paginate(15);
        return response()->json($stores);
    }


    public function form_create()
    {
        return View('stores.form_create');
    }

    public function form_edit()
    {
        return View('stores.form_edit');
    }

    public function create(Request $request)
    {
        $stores = $this->storeRepo->getModel();
        //var_dump($request->all());
        //die();
        $manager = new StoreManager($stores,$request->all());
        //print_r($manager); die();
        $manager->save();
        //Event::fire('update.store',$store->all());

        return response()->json(['estado'=>true, 'nombre'=>$stores->nombreTienda]);
    }

    public function find($id)
    {
        $store = $this->storeRepo->find($id);
        return response()->json($store);
    }

    public function edit(Request $request)
    {
        $stores = $this->storeRepo->find($request->id);
        //var_dump($store);
        //die(); 
        $manager = new StoreManager($stores,$request->all());
        $manager->save();

        //Event::fire('update.store',$store->all());
        return response()->json(['estado'=>true, 'nombre'=>$stores->nombreTienda]);
    }

    
    public function destroy(Request $request)
    {
        $store= $this->storeRepo->find($request->id);
        $store->delete();
        //Event::fire('update.store',$store->all());
        return response()->json(['estado'=>true, 'nombre'=>$store->nombreTienda]);
    }

    public function search($q)
    {
        //$q = Input::get('q');
        $stores = $this->storeRepo->search($q);

        return response()->json($stores);
    }

    public function selectStores(){
        $stores = $this->storeRepo->all();
        return response()->json($stores); 
    }

    public function searchReport($q)
    {
        //$q = Input::get('q');
        $stores = $this->storeRepo->searchReport($q);

        return response()->json($stores);
    }
}