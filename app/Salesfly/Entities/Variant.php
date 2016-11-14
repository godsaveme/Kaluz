<?php
namespace Salesfly\Salesfly\Entities;

class Variant extends \Eloquent {

    protected $table = 'variants';

    protected $fillable = ['codigo',
                            'sku',
                            /*'suppPri',
                            'markup',
                            'price',*/
                            'track',
                            'product_id',
                            /*'observado',*/
                            'estado',
                            'nota',
                            'image',
                            'category',
                            'favorite',
                            'user_id'
                            ];

    public function atributes(){
        return $this->belongsToMany('Salesfly\Salesfly\Entities\Atribut','detAtr','variant_id','atribute_id');
    }

    public function detAtr(){
        return $this->hasMany('\Salesfly\Salesfly\Entities\DetAtr');
    }

    public function product(){
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Product');
    }
     public function detPre(){
        return $this->hasMany('\Salesfly\Salesfly\Entities\DetPres');
    }
    public function detPreONE(){
        return $this->hasOne('\Salesfly\Salesfly\Entities\DetPres');
    }
    public function stock(){
        return $this->hasMany('\Salesfly\Salesfly\Entities\Stock');
    }
    public function presentation(){
        return $this->belongsToMany('\Salesfly\Salesfly\Entities\Presentation','detPres');
    }
    public function warehouse(){
        return $this->belongsToMany('\Salesfly\Salesfly\Entities\Warehouse','stock');
    }
    public function user(){
        return $this->belongsTo('\Salesfly\User');
    }
}