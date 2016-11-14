<?php
namespace Salesfly\Salesfly\Entities;

class Invoices extends \Eloquent {

	protected $table = 'invoices';
    
    protected $fillable = ['serie',
    						'numero',
    						'fecha',
    						'cliente',
    						'direccion',
    						'totalBruto',
    						'descuento',
    						'igv',
							'importe',
    						'porcentajeIgv',
                            'customer_id',
                            'sale_id'];
}