<?php
namespace Salesfly\Salesfly\Entities;

class DetailInvoice extends \Eloquent {

	protected $table = 'detailInvoices';
    
    protected $fillable = ['cantidad',
    						'descripcion',
    						'PrecioUnit',
    						'PrecioVent',
                            'headInvoice_id'];
    
}