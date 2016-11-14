<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\CashMotiveRepo;
use Salesfly\Salesfly\Managers\CashMotiveManager;

class CashMotivesController extends Controller
{
    
    protected $cashMotiveRepo;

    public function __construct(CashMotiveRepo $cashMotiveRepo)
    {
        $this->cashMotiveRepo = $cashMotiveRepo;
    }

    public function select(){
        $cashMotive = $this->cashMotiveRepo->all();
        return response()->json($cashMotive);
    }
    public function index() 
    {
        //
    }
    public function search($q)
    {
        //$q = Input::get('q');
        $cashMotives = $this->cashMotiveRepo->search($q);

        return response()->json($cashMotives);
    }
    public function searchMotive($q)
    {
        //$q = Input::get('q');
        $cashMotives = $this->cashMotiveRepo->searchMotive($q);

        return response()->json($cashMotives);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
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
