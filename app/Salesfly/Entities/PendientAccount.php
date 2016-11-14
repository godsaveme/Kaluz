<?php
namespace Salesfly\Salesfly\Entities;

class PendientAccount extends \Eloquent {

	protected $table = 'pendientAccounts';
    
    protected $fillable = ['Saldo','estado','fecha','orderPurchase_id','supplier_id'];

}