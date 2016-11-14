<?php
namespace Salesfly\Salesfly\Managers;
class PaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [   
            'NumFactura'=>'', 
            'NumSerie'=>'',
            'tipoDoc'=>'',          
            'montoTotal'=>'',
            'Acuenta'=>'',
            'Saldo'=>'',
            'orderPurchase_id'=>'',
            'purchase_id'=>'',
            'supplier_id'=>''
                  ];
        return $rules;
    }}