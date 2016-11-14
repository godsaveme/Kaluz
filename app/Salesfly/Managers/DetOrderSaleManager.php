<?php
namespace Salesfly\Salesfly\Managers;
class DetOrderSaleManager extends BaseManager {

    public function getRules() 
    {
        $rules = [              
            'precioProducto'=> '',
            'precioVenta'=> '',
            'cantidad'=> '',
            'descuento'=> '',
            'subTotal'=> '',
            'estado'=> '',
            'orderSale_id'=> '',
            'canPendiente'=> '',
            'canEntregado'=> '',
            'detPre_id'=> ''];
        return $rules;
    }}