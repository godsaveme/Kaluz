<?php

namespace Salesfly\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\PromotionRepo;
use Salesfly\Salesfly\Managers\PromotionManager;

class PromotionsController extends Controller
{
    protected $promotionRepo;

    public function __construct(PromotionRepo $promotionRepo)
    {
        $this->promotionRepo = $promotionRepo;
    }

    public function paginatep(){
        $promotions = $this->promotionRepo->paginate(15);
        return response()->json($promotions);
    }
    public function all()
    {
        $promotions = $this->promotionRepo->paginate(15);
        return response()->json($promotions);
        //var_dump($employees);
    }

    public function index()
    {
        return View('promotions.index');
    }
    public function find($id)
    {
        $promotions = $this->promotionRepo->find($id);
        return response()->json($promotions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $promotion = $this->promotionRepo->getModel();
        $manager = new PromotionManager($promotion,$request->all());
        $manager->save();
        return response()->json(['estado'=>true, 'nombre'=>$promotion->nombre]);
    }

    public function form_create()
    {
        return View('promotions.form_create');
    }
    public function form_edit()
    {
        return View('promotions.form_create');
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
        return View('promotions.form_edit');
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
    public function destroy(Request $request)
    {
        $promotion= $this->promotionRepo->find($request->id);
        $promotion->delete();
        return response()->json(['estado'=>true, 'nombre'=>$promotion->nombre]);
    }
}
