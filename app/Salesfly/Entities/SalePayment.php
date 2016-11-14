<?php
namespace Salesfly\Salesfly\Entities;

class SalePayment extends \Eloquent {

	protected $table = 'salePayments';
    
    protected $fillable = ['MontoTotal',
    						'Acuenta',
    						'Saldo',
    						'estado',
    						'sale_id',
                            'orderSale_id',
                            'separateSale_id',
    						'customer_id'];
    						
    public function customer(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Customer','customer_id');
    }
}