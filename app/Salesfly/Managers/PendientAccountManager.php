<?php
namespace Salesfly\Salesfly\Managers;
class PendientAccountManager extends BaseManager {

    public function getRules()
    {
        $rules = [   
            'Saldo'=>'',
            'estado'=>'',
            'orderPurchase_id'=>'',
            'supplier_id'=>'required',
            'fecha'=>''
                  ];
        return $rules;
    }}