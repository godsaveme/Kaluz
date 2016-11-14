<?php
namespace Salesfly\Salesfly\Entities;

class Station extends \Eloquent {

	protected $table = 'stations';
    
    protected $fillable = ['nombre','shortname','descripcion'];

}