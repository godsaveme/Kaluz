<?php
namespace Salesfly\Salesfly\Entities;

class DetOrderSale extends \Eloquent {

	protected $table = 'detOrderSales';
    
    protected $fillable = ['precioProducto',
    						'precioVenta',
    						'cantidad',
    						'descuento',
    						'subTotal',
    						'estado',
    						'orderSale_id',
    						'canPendiente',
							'canEntregado',
    						'detPre_id'];
}