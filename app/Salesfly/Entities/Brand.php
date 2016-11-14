<?php
namespace Salesfly\Salesfly\Entities;

class Brand extends \Eloquent {

	protected $table = 'brands';
    
    protected $fillable = ['nombre','shortname','descripcion'];

}