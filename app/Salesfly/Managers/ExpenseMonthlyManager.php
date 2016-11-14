<?php
namespace Salesfly\Salesfly\Managers;
class ExpenseMonthlyManager extends BaseManager {

    public function getRules()
    {
    	$rules = ['name'=> 'required'];
        
        return $rules;
    }
}