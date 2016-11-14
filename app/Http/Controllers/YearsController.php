<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\YearRepo;
use Salesfly\Salesfly\Managers\YearManager;

class YearsController extends Controller
{
    protected $yearRepo;

    public function __construct(YearRepo $yearRepo)
    {
        $this->yearRepo = $yearRepo;
    }

    public function find($id)
    {
        $year = $this->yearRepo->find($id);
        return response()->json($year);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        $material = $this->yearRepo->getModel();

        $manager = new YearManager($material,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'year'=>$material->year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
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
    public function edit(Request $request)
    {
        $year = $this->yearRepo->find($request->id);

        $manager = new YearManager($year,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'year'=>$year->year]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $Year= $this->yearRepo->find($request->id);
        $Year->delete();
        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'year'=>$Year]);
    }

    public function select()
    {
        $years = $this->yearRepo->lists();
        return response()->json($years);
    }
}
