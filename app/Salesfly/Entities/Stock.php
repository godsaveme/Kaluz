<?php
namespace Salesfly\Salesfly\Entities;

class Stock extends \Eloquent {

    protected $table = 'stock';

    protected $fillable = ['stockActual',
                            'stockMin',
                            'stockMinSoles',
                            'stockPedidos',
                            'stockSeparados',
                            'porLlegar',
                            'variant_id',
                            'warehouse_id'];
 public function variant()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Variant');
      }
      public function warehouse()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Warehouse');
      }

}