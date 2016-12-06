<?php
namespace Salesfly\Salesfly\Entities;

class OtherPdetail extends \Eloquent {

	protected $table = 'OtherPdetails';
    
    protected $fillable = ['cantidad',
                           'descripcion',
                           'PrecioUnit',
                           'PrecioFinal',
                           'otherPhead_id'];

}