<?php
namespace Salesfly\Salesfly\Entities;

class FBnumber extends \Eloquent {

	protected $table = 'FBnumbers';
    
    protected $fillable = ['numFactura','numBoleta','caja_id'];

}