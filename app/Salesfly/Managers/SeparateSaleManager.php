<?php
namespace Salesfly\Salesfly\Managers;
class SeparateSaleManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'fechaPedido'=> '',
            'fechaEntrega'=> '',
            'montoTotal'=> '',
            'montoBruto'=> '',
            'descuento'=> '',
            'fechaAnulado'=> '',
            'estado'=>'',
            'employee_id'=> '',
            'customer_id'=> '',
            'igv'=> '',
            'notas'=> '',
            'tipo' => ''
                  ];
        return $rules;
    }} 