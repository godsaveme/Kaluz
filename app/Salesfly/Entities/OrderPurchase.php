<?php
namespace Salesfly\Salesfly\Entities;

class OrderPurchase extends \Eloquent {

    protected $table = 'orderPurchases';
    
    protected $fillable = [ 
                    'fechaPedido',
                    'fechaPrevista',
                    'descuento',
                    'montoBruto',
                    'montoTotal',
                    'Estado',
                    'warehouses_id',
                    'supplier_id',
                    'montoBase',
                    'igv',
                    'checkIgv'];
     public function warehouse()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Warehouse');
    }
     public function supplier()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Supplier');
    }
    public function detpres(){
        return $this->belongsToMany('\Salesfly\Salesfly\Entities\DetPres','detailOrderPurchases','orderPurchases_id','detPres_id');
    }

}