<?php
namespace Salesfly\Salesfly\Entities;

class Atribut extends \Eloquent {

	protected $table = 'atributes';
    
    protected $fillable = ['nombre','shortname','descripcion'];

}