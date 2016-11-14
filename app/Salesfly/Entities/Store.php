<?php
namespace Salesfly\Salesfly\Entities;
use Illuminate\Database\Eloquent\Model;

class Store extends \Eloquent {

    protected $table = 'stores';
    
    protected $fillable = [ 
                    'nombreTienda',
                    'razonSocial',
                    'ruc',
                    'direccion',
                    'distrito',
                    'provincia',
                    'departamento',
                    'pais',
                    'email',
                    'website'];
    public function warehouses()
    {
        return $this->hasMany('warehouse');
    }

}