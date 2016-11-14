<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\DetSaleRepo;
use Salesfly\Salesfly\Managers\DetSaleManager;

class DetSalesController extends Controller {

    protected $detSaleRepo;

    public function __construct(DetSaleRepo $detSaleRepo)
    {
        $this->detSaleRepo = $detSaleRepo;
    }

    

    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $detSale = $this->detSaleRepo->searchDetalle($id);

        return response()->json($detSale);
    }
     public function listarVentasDia()
    {
        //$q = Input::get('q');
        $detSale = $this->detSaleRepo->listarVentasDia();

        return response()->json($detSale);
    }
}