<?php

namespace Salesfly\Salesfly\Managers;
class SalePaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'MontoTotal'=>'',
                    'Acuenta'=>'',
            'Saldo' => '',
            'estado' => '',
            'sale_id'=> '',
            'separateSale_id'=> '',
            'orderSale_id'=> '',
            'customer_id' => ''];
        return $rules;
    }
} 