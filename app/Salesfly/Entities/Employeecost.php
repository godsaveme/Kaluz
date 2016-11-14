<?php
namespace Salesfly\Salesfly\Entities;

class Employeecost extends \Eloquent {

	protected $table = 'employeecosts';
    
    protected $fillable = ['SueldoFijo','comisiones','seguro','menu','pasajes','descuento','total','employee_id'];
     public function employee()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Employee');
      }
}