<?php

namespace Salesfly\Salesfly\Managers;

class DetExpenseManager extends BaseManager{

    public function getRules(){
                 $rules = ['detalle'=>'',
                           'igv'=>'between:0,9999999999.00',
                           'total'=>'between:0,9999999999.00',
                           'expense_id'=>'required'];
        return $rules;
    }
}