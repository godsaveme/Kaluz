<?php
namespace Salesfly\Salesfly\Entities;

class DetailPurchase extends \Eloquent {

	protected $table = 'detailPurchases';
    
    protected $fillable = ['producto','descuento',
    						'montoBruto',
    						'montoTotal',
    						'purchases_id',
    						'detPres_id',
    						'preProducto',
    						'preCompra',
    						'cantidad'
    						];

    public function detPres()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\DetPres');
      }
      public function purchase()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Purchase');
      }

}