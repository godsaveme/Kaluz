<?php
namespace Salesfly\Salesfly\Entities;
use Illuminate\Database\Eloquent\Model;

class CashHeader extends \Eloquent {

    protected $table = 'cashHeaders';
    
    protected $fillable = [ 
                    'nombre',
                    'ambiente',
                    'estado',
                    'descripcion',
                    'store_id'];

    public function store(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Store','store_id');
    }

}