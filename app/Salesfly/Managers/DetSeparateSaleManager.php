<?php
namespace Salesfly\Salesfly\Managers;
class DetSeparateSaleManager extends BaseManager {

    public function getRules() 
    {
        $rules = [              
            'precioProducto'=> '',
            'precioVenta'=> '',
            'cantidad'=> '',
            'descuento'=> '',
            'subTotal'=> '',
            'estado'=> '',
            'separateSale_id'=> '',
            'canPendiente'=> '',
            'canEntregado'=> '',
            'detPre_id'=> ''];
        return $rules;
    }} 