<?php
namespace Salesfly\Salesfly\Managers;
class DetPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fecha'=>'',
            'payment_id'=>'',
            'tipoPago'=>'',
            'methodPayment_id'=>'',
            'montoPagado'=>'',
            'Saldo_F'=>'',
            'detCash_id'=>'',
            'cashMonthly_id'=>''
                  ];
        return $rules;
    }}