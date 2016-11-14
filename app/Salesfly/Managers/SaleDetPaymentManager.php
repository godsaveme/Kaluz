<?php

namespace Salesfly\Salesfly\Managers;
class SaleDetPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [ 
                    'fecha'=>'',
                    'monto'=>'',
                    'numCaja'=>'',
                    'tipoPago'=>'',
            'salePayment_id' => '',
            'saleMethodPayment_id' => '',
            'detCash_id'=> ''
                  ];
        return $rules;
    }
} 