<?php
namespace Salesfly\Salesfly\Entities;

class DetSeparateSale extends \Eloquent {

	protected $table = 'detSeparateSales';
    
    protected $fillable = ['precioProducto',
    						'precioVenta',
    						'cantidad',
    						'descuento',
    						'subTotal',
    						'estado',
    						'separateSale_id',
    						'canPendiente',
							'canEntregado',
    						'detPre_id'];
}