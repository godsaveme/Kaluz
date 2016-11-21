<?php
namespace Salesfly\Salesfly\Entities;

class OtherPhead extends \Eloquent {

	protected $table = 'OtherPheads';
    
    protected $fillable = ['fecha',
                           'proveedor',
                           'ruc',
                           'direccion',
                           'numeroDocumento',
                           'serie',
                           'MontoSubTotal',
                           'igv',
                           'BaseImponible',
                           'MontoTotal',
                           'tipoDoc',
                           'checkIgv',
                           'montoPagado',
                           'Saldo'];
   public function OtherPdetail()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\OtherPdetail','otherPhead_id','id');
    }
   

}