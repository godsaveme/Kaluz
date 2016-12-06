<?php
namespace Salesfly\Salesfly\Entities;

class Expense extends \Eloquent {

	protected $table = 'expenses';
    
    protected $fillable = ['fecha',
                           'proveedor',
                           'ruc',
                           'direccion',
                           'numeroDocumento',
                           'serie',
                           'MontoTotal',
                           'tipoDoc',
                           'montoPagado',
                           'Saldo'
                           ];
   

}