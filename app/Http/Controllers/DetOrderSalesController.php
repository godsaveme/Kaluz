<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetOrderSaleRepo;
use Salesfly\Salesfly\Managers\DetOrderSaleManager; 

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class DetOrderSalesController extends Controller {

    protected $detOrderSaleRepo;

    public function __construct(DetOrderSaleRepo $detOrderSaleRepo)
    {
        $this->detOrderSaleRepo = $detOrderSaleRepo;
    }

     

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $detorderSale = $this->detOrderSaleRepo->searchDetalle($id);

        return response()->json($detorderSale);
    }

    public function edit(Request $request)
    {
        $detorderSale = $this->detOrderSaleRepo->find($request->id);
        $manager = new DetOrderSaleManager($detorderSale,$request->all());
        $manager->save();

        $stokRepo;
        $stokRepo = new StockRepo;
        $cajaSave=$stokRepo->getModel();
        $stockOri = $stokRepo->find($request->id);

        $stock = $stokRepo->find($request->idStock);
        if ($request->estad==true) {
            $stock->stockPedidos= $stock->stockPedidos-$request->canPendiente;
        }else{
            $stock->stockPedidos= $stock->stockPedidos+$request->canPendiente;
        }
        

        $stock->save();

        //var_dump($stock);die();

        //$manager1 = new StockManager($stockOri,$stock);
        //$manager1->save();

        return response()->json(['estado'=>true, 'nombre'=>$detorderSale->nombre]);

    }  
}