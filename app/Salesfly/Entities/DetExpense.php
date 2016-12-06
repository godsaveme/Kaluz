<?php
namespace Salesfly\Salesfly\Entities;

class DetExpense extends \Eloquent {

	protected $table = 'detExpenses';
    
    protected $fillable = ['detalle',
                           'igv',
                           'total',
                           'expense_id'];
    public function Expenses()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Expense','expense_id','id');
    }
   

}