<?php

namespace Salesfly\Http\Controllers\Layout;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Entities\Store;
use Salesfly\Salesfly\Entities\Warehouse;

class LayoutController extends Controller
{
    protected $layout;

    public function __construct(){
        $this->layout = 'layout';
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $storeId = session('storeId');
        $warehouseId = session('warehouseId');
        $productTypeId = session('prodType');
        return response()->view($this->layout,[
            'storeId' => $storeId,
            'warehouseId' => $warehouseId,
            'productTypeId' => $productTypeId
        ]);
    }

    /** Funcion que recibe los parametros de sucursal, almacén y tipo de producto para ponerlos en session
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request){
        //dd($request->all());
        session(['storeId' => $request->storeId]);
        session(['warehouseId' => $request->warehouseId]);
        session(['productTypeId' => $request->prodType]);

        $storeId = session('storeId');
        $storeName = Store::find($storeId)->nombreTienda;
        session(['storeName' => $storeName]);

        $warehouseId = session('warehouseId');
        $warehouseName = Warehouse::find($warehouseId)->nombre;
        session(['warehouseName' => $warehouseName]);

        $productTypeId = session('productTypeId');
        if($productTypeId == 1){
            $productName = 'Zapatos';
        }elseif($productTypeId == 2){
            $productName = 'Accesorios';
        }else{
            $productName = 'No selecc.';
        }
        session(['productName' => $productName]);


        return response()->view($this->layout);
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
