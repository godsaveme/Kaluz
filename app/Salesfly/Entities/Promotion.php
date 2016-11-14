<?php
namespace Salesfly\Salesfly\Entities;

class Promotion extends \Eloquent {

	protected $table = 'promotions';
    
    protected $fillable = ['nombre',
    						'multiplicador',
    						'descripcion',
    						'cantidad'
    						];
}