<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\ExpenseMonthly;

class ExpenseMonthlyRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new ExpenseMonthly;
    }

    public function search($q)
    {
        $ExpenseMonthly =ExpenseMonthly::where('name','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $ExpenseMonthly;
    }

    public function lists()
    {
        $expenseMonthly = ExpenseMonthly::select('name','id')->get();
        return $expenseMonthly;
    }
    public function find($id){
        $expenseMonthly = ExpenseMonthly::where('id','=',$id)->first();
        return $expenseMonthly;
    }
} 