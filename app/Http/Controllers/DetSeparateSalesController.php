<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetSeparateSaleRepo;
use Salesfly\Salesfly\Managers\DetSeparateSaleManager;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class DetSeparateSalesController extends Controller {

    protected $detSeparateSaleRepo;

    public function __construct(DetSeparateSaleRepo $detSeparateSaleRepo)
    {
        $this->detSeparateSaleRepo = $detSeparateSaleRepo;
    }

     

    public function searchDetalle($id) 
    {
        //$q = Input::get('q');
        $detorderSale = $this->detSeparateSaleRepo->searchDetalle($id);

        return response()->json($detorderSale);
    }

    public function listarVentasDia()
    {
        //$q = Input::get('q');
        $detSale = $this->detSeparateSaleRepo->listarVentasDia();

        return response()->json($detSale);
    }

    public function edit(Request $request)
    {
        var_dump($request->all()); die();
        \DB::beginTransaction();
        $pendiente = $request->canPendiente;
        $detorderSale = $this->detSeparateSaleRepo->find($request->id);
        $request->merge(['canPendiente' => 0]);
        $manager = new DetSeparateSaleManager($detorderSale,$request->all());
        $manager->save();

        //$detorderSale->canPendiente = 0;
        //$detorderSale->save();

        $stokRepo;
        $stokRepo = new StockRepo;
        $cajaSave=$stokRepo->getModel();
        $stockOri = $stokRepo->find($request->id);

        $stock = $stokRepo->find($request->idStock);
        if ($request->estad==true) {
            $stock->stockSeparados= $stock->stockSeparados-$pendiente;
        }else{
            $stock->stockSeparados= $stock->stockSeparados+$pendiente;
        }
        

        $stock->save();

        //var_dump($stock);die();

        //$manager1 = new StockManager($stockOri,$stock);
        //$manager1->save();
        \DB::commit();
        return response()->json(['estado'=>true, 'nombre'=>$detorderSale->nombre]);

    }
}