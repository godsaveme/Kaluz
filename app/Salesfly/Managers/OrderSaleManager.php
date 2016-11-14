<?php
namespace Salesfly\Salesfly\Managers;
class OrderSaleManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=> 'required',
            'fechaEntrega'=> '',
            'montoTotal'=> '',
            'montoBruto'=> '',
            'descuento'=> '',
            'fechaAnulado'=> '',
            'estado'=>'',
            'employee_id'=> '',
            'customer_id'=> '',
            'igv'=> '',
            'notas'=> ''
                  ];
        return $rules;
    }} 
 