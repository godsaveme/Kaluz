<?php
namespace Salesfly\Salesfly\Entities;

class DetSale extends \Eloquent {

	protected $table = 'detSales';
    
    protected $fillable = ['precioProducto',
    						'precioVenta',
    						'cantidad',
    						'descuento',
    						'subTotal',
    						'sale_id',
    						'detPre_id'];
}