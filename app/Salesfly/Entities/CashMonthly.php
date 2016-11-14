<?php
namespace Salesfly\Salesfly\Entities;

class CashMonthly extends \Eloquent {

	protected $table = 'cashMonthlys';
    
    protected $fillable = ['amount',
    'descripcion',
    'expenseMonthlys_id',
    'fecha'];

    /*
    'months_id',
    'years_id'

    public function year(){
    	return $this->belongsTo('Salesfly\Salesfly\Entities\Year','years_id');
    }
    public function month(){
    	return $this->belongsTo('Salesfly\Salesfly\Entities\Month','months_id');
    }*/
    public function expenseMonthly(){
    	return $this->belongsTo('Salesfly\Salesfly\Entities\ExpenseMonthly','expenseMonthlys_id');
    }

}
