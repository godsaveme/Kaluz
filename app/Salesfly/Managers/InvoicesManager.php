<?php
namespace Salesfly\Salesfly\Managers;
class InvoicesManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'serie'=>'',
            'numero'=>'',
            'fecha'=>'',
            'cliente'=>'',
            'direccion'=>'',
             'totalBruto'=>'between:0,9999999999.00',
             'descuento'=>'between:0,9999999999.00',
             'igv'=>'between:0,9999999999.00',
             'importe'=>'between:0,9999999999.00',
             'porcentajeIgv'=>'between:0,9999999999.00',
             'customer_id'=>'',
             'sale_id'=>''];
        return $rules;
    }}