<?php
namespace Salesfly\Salesfly\Managers;
class DetailOrderPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = ['producto'=>'',
                   'descuento'=> 'between:0,9999999999.00',
        			'montoBruto'=>'between:0,9999999999.00',
        			'montoTotal'=>'between:0,9999999999.00',
        			'detPres_id'=>'required',
        			'orderPurchases_id'=>'required',
                    'preProducto'=>'',
                    'preCompra'=>'',
                    'cantidad'=>'between:0,9999999999.00',
                    'Cantidad_Ll'=>'',
                    'pendiente'=>''
       				 ];
        return $rules;
    }
}