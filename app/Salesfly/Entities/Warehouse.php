<?php
namespace Salesfly\Salesfly\Entities;

class Warehouse extends \Eloquent {

    protected $table = 'warehouses';
    
    protected $fillable = [ 
                    'nombre',
                    'shortname',
                    'descripcion',
                    'capacidad',
                    'store_id'];
     public function store()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Store');
    }

}