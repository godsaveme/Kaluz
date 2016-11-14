<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\SaleMethodPaymentRepo;
use Salesfly\Salesfly\Managers\SaleMethodPaymentManager;

class SaleMethodPaymentController extends Controller {

    protected $saleMethodPaymentRepo;

    public function __construct(SaleMethodPaymentRepo $saleMethodPaymentRepo)
    {
        $this->saleMethodPaymentRepo = $saleMethodPaymentRepo;
    }
    public function select(){
        $MethodPayment = $this->saleMethodPaymentRepo->all();
        return response()->json($MethodPayment);
    }

    
/*
    public function searchDetalle($id)
    {
        //$q = Input::get('q');
        $saleDetPayment = $this->saleMethodPaymentRepo->searchDetalle($id);

        return response()->json($saleDetPayment);
    }
*/
}