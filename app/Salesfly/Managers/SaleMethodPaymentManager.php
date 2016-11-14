<?php

namespace Salesfly\Salesfly\Managers;
class SaleMethodPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombre'=>'',
                    'descripcion'=>''];
        return $rules;
    }
} 