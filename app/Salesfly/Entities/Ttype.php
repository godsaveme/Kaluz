<?php
namespace Salesfly\Salesfly\Entities;

class Ttype extends \Eloquent {

	protected $table = 'types';
    
    protected $fillable = ['nombre',
    'shortname','descripcion'];

}