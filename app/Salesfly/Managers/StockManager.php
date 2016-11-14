<?php

namespace Salesfly\Salesfly\Managers;
class StockManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'stockActual'=>'between:0,9999999999.00',
            'stockMin'=>'between:0,9999999999.00',
            'stockMinSoles'=>'between:0,9999999999.00',
            'stockPedidos'=>'between:0,9999999999.00',
            'stockSeparados'=>'between:0,9999999999.00',
            'porLlegar'=>'between:0,9999999999.00',
            'variant_id'=>'required',
            'warehouse_id'=>'required'
        ];
        return $rules;
    }
}

