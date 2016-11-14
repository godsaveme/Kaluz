<?php
namespace Salesfly\Salesfly\Entities;

class MethodPayment extends \Eloquent {

	protected $table = 'methodPayments';
    
    protected $fillable = ['nombre','descripcion'];

}