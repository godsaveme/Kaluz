<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Expense;

class ExpenseRepo extends BaseRepo{
    public function getModel()
    {
        return new Expense;
    }

    public function search($q)
    {
        $brands =Expense::where('nombre','like', $q.'%')
                    ->orWhere('shortname','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function validarNoRepit($text){
        $brands =Expense::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $brands;
    }
}