<?php
namespace Salesfly\Salesfly\Entities;

class Sale extends \Eloquent {

	protected $table = 'sales';
    
    protected $fillable = ['fechaPedido',
    						'montoTotal',
    						'montoBruto',
    						'descuento',
    						'fechaAnulado',
    						'customer_id',
    						'employee_id',
    						'estado',
    						'igv',
    						'notas',
                            'orderSale_id',
                            'separateSale_id',
                            'detCash_id']; 

    public function customer(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Customer','customer_id');
    }
    public function employee(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Employee','employee_id');
    }
}

