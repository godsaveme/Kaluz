<?php
namespace Salesfly\Salesfly\Entities;

class DetailOrderPurchase extends \Eloquent {

	protected $table = 'detailOrderPurchases';
    
    protected $fillable = ['producto','descuento',
    						'montoBruto',
    						'montoTotal',
    						'orderPurchases_id',
    						'detPres_id',
    						'preProducto',
    						'preCompra',
    						'cantidad',
                'Cantidad_Ll',
                'pendiente'
    						];

    public function detPres()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\DetPres');
      }
      public function orderPurchase()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\OrderPurchase');
      }

}