<?php
namespace Salesfly\Salesfly\Managers;
class CashMonthlyManager extends BaseManager {

    public function getRules()
    {
        $rules = ['amount'=> '',
    				'descripcion'=>'',
    				'expenseMonthlys_id'=> 'required',
    				'fecha'=> 'required'];
        return $rules;
    }
}