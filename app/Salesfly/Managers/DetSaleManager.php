<?php
namespace Salesfly\Salesfly\Managers;
class DetSaleManager extends BaseManager {

    public function getRules() 
    {
        $rules = [              
            'precioProducto'=> '',
            'precioVenta'=> '',
            'cantidad'=> '',
            'descuento'=> '',
            'subTotal'=> '',
            'sale_id'=> '',
            'detPre_id'=> ''];
        return $rules;
    }}