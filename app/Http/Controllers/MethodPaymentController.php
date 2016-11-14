<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\MethodPaymentRepo;
use Salesfly\Salesfly\Managers\MethodPaymentManager;

class MethodPaymentController extends Controller {

    protected $methodPaymentRepo;

    public function __construct(MethodPaymentRepo $methodPaymentRepo)
    {
        $this->methodPaymentRepo = $methodPaymentRepo;
    }

    public function paginatep(){
        $persons = $this->methodPaymentRepo->paginate(15);
        return response()->json($persons);
    }
    public function create(Request $request)
    {

        $methodPayment = $this->methodPaymentRepo->getModel();
        
        $manager = new MethodPaymentManager($methodPayment,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'nombre'=>$methodPayment->nombre]);
    }

    public function find($id)
    {
        $methodPayment = $this->methodPaymentRepo->methodPaymentById($id);
        return response()->json($methodPayment);
    }

    public function edit(Request $request)
    {
        $methodPayment = $this->methodPaymentRepo->find($request->id);
        $manager = new MethodPaymentManager($methodPayment,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$methodPayment->nombre]);
    }
 
}