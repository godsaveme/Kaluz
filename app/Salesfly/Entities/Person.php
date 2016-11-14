<?php
namespace Salesfly\Salesfly\Entities;

class Person extends \Eloquent {

	protected $table = 'persona';
    
    protected $fillable = ['nombres','apPaterno'];

}