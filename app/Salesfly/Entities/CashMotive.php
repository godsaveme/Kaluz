<?php
namespace Salesfly\Salesfly\Entities;

class CashMotive extends \Eloquent {

	protected $table = 'cashMotives';
    
    protected $fillable = ['nombre',
    						'observacion',
    						'tipo'];
}