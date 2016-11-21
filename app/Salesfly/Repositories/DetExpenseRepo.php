<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetExpense;

class DetExpenseRepo extends BaseRepo{
    public function getModel()
    {
        return new DetExpense;
    }

    public function search($q)
    {
        $brands =DetExpense::where('nombre','like', $q.'%')
                    ->orWhere('shortname','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function validarNoRepit($text){
        $brands =DetExpense::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $brands;
    }
       public function traendoDetGastos($q){
       $InputStock=DetExpense::join("SunatAcounts","SunatAcounts.id","=","detExpenses.acount_id")
                            ->select(\DB::raw("detExpenses.*,SunatAcounts.nombre as nomCuenta,detExpenses.total as PrecioFinal"))
                            ->where("detExpenses.expense_id","=",$q)
                            ->paginate(50);
        return $InputStock;
    }

}