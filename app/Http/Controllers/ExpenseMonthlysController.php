<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\ExpenseMonthlyRepo;
use Salesfly\Salesfly\Managers\ExpenseMonthlyManager;

class ExpenseMonthlysController extends Controller
{
    protected $expenseMonthlyRepo;

    public function __construct(ExpenseMonthlyRepo $expenseMonthlyRepo)
    {
        $this->expenseMonthlyRepo = $expenseMonthlyRepo;
    }   

     public function find($id)
    {
        $expense = $this->expenseMonthlyRepo->find($id);
        return response()->json($expense);
    }
    public function traerdata($id){
       $expenseMonthly = $this->expenseMonthlyRepo->mostrardata($id);
        return response()->json($expenseMonthly);
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
        
        $material = $this->expenseMonthlyRepo->getModel();

        $manager = new ExpenseMonthlyManager($material,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'name'=>$material->name]);
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
        $expense = $this->expenseMonthlyRepo->find($request->id);

        $manager = new ExpenseMonthlyManager($expense,$request->all());
        $manager->save();

        return response()->json(['estado'=>true, 'expense'=>$expense->name]);
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
        $expense= $this->expenseMonthlyRepo->find($request->id);
        $expense->delete();
        //Event::fire('update.material',$material->all());
        return response()->json(['estado'=>true, 'name'=>$expense->name]);
    }

    public function select()
    {
        $expenseMonthly = $this->expenseMonthlyRepo->lists();
        //return 'Hola';
        return response()->json($expenseMonthly);
    }
}
