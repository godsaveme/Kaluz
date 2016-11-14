<?php
namespace Salesfly\Salesfly\Entities;

class practica extends \Eloquent {

	protected $table = 'practica';
    
    protected $fillable = ['nombre',
    						'apellidos',
    						'edad',
    						];

    public $timestamps = false;

}