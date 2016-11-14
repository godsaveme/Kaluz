<?php

namespace Salesfly\Salesfly\Managers;
class HeadInvoiceManager extends BaseManager {

    public function getRules()
    {
          $rules = [          'numero'=>'',
                            'dni'=>'',
                            'direccion_cliente'=>'',
                            'cliente'=>'',
                            'direccion'=>'',
                            'ruc'=>'',
                            'GRemicion'=>'',
                            'subTotal'=>'',
                            'igv'=>'',
                            'Total'=>'',
                            'venta_id'=>'',
                            'cliente_id'=>'',
                            'tipoDoc'=>'',
                            'vuelto'=>''];
        return $rules;
    }
}