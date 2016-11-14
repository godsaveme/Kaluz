<?php
namespace Salesfly\Salesfly\Entities;

class DetAtr extends \Eloquent {

    protected $table = 'detAtr';

    protected $fillable = ['variant_id','atribute_id','descripcion'];
public function variant()
      {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Variant');
      }
}