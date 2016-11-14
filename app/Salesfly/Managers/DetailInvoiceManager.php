<?php

namespace Salesfly\Salesfly\Managers;
class DetailInvoiceManager extends BaseManager {

    public function getRules()
    {
        $rules = [          'cantidad'=>'',
                            'descripcion'=>'',
                            'PrecioUnit'=>'',
                            'PrecioVent'=>'',
                            'headInvoice_id'=>''];
        return $rules;
    }
}