<?php
namespace Salesfly\Salesfly\Entities;

class SaleDetPayment extends \Eloquent {

	protected $table = 'saledetPayments';
    
    protected $fillable = ['fecha',
    						'monto',
    						'numCaja',
    						'tipoPago',
    						'salePayment_id', 
    						'saleMethodPayment_id',
                            'detCash_id'];

    public function saleMethodPayment(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\SaleMethodPayment','saleMethodPayment_id');
    }
}