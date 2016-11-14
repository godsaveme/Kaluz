<?php
namespace Salesfly\Salesfly\Entities;

class SaleMethodPayment extends \Eloquent {

	protected $table = 'saleMethodPayments';
    
    protected $fillable = ['nombre',
    						'descripcion'];
}