<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetCashRepo;
use Salesfly\Salesfly\Managers\DetCashManager;

class DetCashController extends Controller
{
    protected $detCashRepo;

    public function __construct(DetCashRepo $detCashRepo)
    {
        $this->detCashRepo = $detCashRepo;
    }
    public function compCajaActiva($id){
       $cash = $this->detCashRepo->compCajaActiva($id);
        return response()->json($cash);
    }
     public function ver_ventas()
    {
        $detCash = $this->detCashRepo->ver_ventas(auth()->user()->id);
        return response()->json($detCash);
    }

    public function ver_ventasSeparate()
    {
        $detCash = $this->detCashRepo->ver_ventasSeparate(auth()->user()->id);
        return response()->json($detCash);
    }
    public function all()
    {
        $detCash = $this->detCashRepo->paginate(15);
        return response()->json($detCash);
        //var_dump($materials);
    }

    public function paginatep(){
        $detCash = $this->detCashRepo->paginate(15);
        return response()->json($detCash);
    }

    public function find($id)
    {
        $cash = $this->detCashRepo->find($id);
        return response()->json($cash);
    }

    public function search($q)
    {
        $detCash = $this->detCashRepo->search($q);

        return response()->json($detCash);
    }
    public function searchSale($q)
    {
        $detCash = $this->detCashRepo->searchSale($q);
        return response()->json($detCash);
    }
    public function searchOrderSale($q)
    {
        $detCash = $this->detCashRepo->searchOrderSale($q);
        return response()->json($detCash);
    }
    public function searchSeparateSale($q)
    {
        $detCash = $this->detCashRepo->searchSeparateSale($q);
        return response()->json($detCash);
    }

    public function index()
    {
        return View('detCashes.index');
    }

    public function form_create()
    {
        return View('detCashes.form_create');
    }
    public function form_edit() 
    {
        return View('detCashes.form_edit');
    }

    public function create(Request $request)
    {
        $detCash = $this->detCashRepo->getModel();
        $request->merge(array('fecha'=>date('Y-m-d'),'hora'=>date('H:i:s')));
        $manager = new DetCashManager($detCash,$request->all());
        $manager->save();

        return response()->json(['estado'=>true]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
