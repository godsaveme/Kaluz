<?php
namespace Salesfly\Salesfly\Entities;

class Material extends \Eloquent {

	protected $table = 'materials';
    
    protected $fillable = ['nombre','shortname','descripcion'];

}