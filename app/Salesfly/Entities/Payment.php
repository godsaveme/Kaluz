<?php
namespace Salesfly\Salesfly\Entities;

class Payment extends \Eloquent {

	protected $table = 'payments';
    
    protected $fillable = ['NumFactura','NumSerie','tipoDoc','montoTotal','Acuenta','Saldo','orderPurchase_id','purchase_id','supplier_id'];

}