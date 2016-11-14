<?php
namespace Salesfly\Salesfly\Entities;

class Purchase extends \Eloquent {

    protected $table = 'purchases';
    
    protected $fillable = [ 
                    'fechaEntrega',
                    'descuento',
                    'montoBruto',
                    'montoTotal',
                    'orderPurchase_id',
                    'warehouses_id',
                    'supplier_id',
                    'observacion',
                    'montoBase',
                    'igv',
                    'checkIgv'];
     public function warehouse()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Warehouse');
    }
    public function orderPurchase()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\OrderPurchase');
    }
     public function supplier()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Supplier');
    }
    public function detpres(){
        return $this->belongsToMany('\Salesfly\Salesfly\Entities\DetPres','detailPurchases','purchases_id','detPres_id');
    }

}