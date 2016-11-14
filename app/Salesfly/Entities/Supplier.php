<?php
namespace Salesfly\Salesfly\Entities;

class Supplier extends \Eloquent {

	protected $table = 'suppliers';
    
    protected $fillable = ['nombres',
    						'apellidos',
                            'empresa',
    						'codigo',
    						'direccionfiscal',
    						'ruc',
							'dni',
    						'numcuenta',
    						'fechanac',
    						'fijo',
                             'movl',
    						'email',
    						'website',
    						'genero',
    						'direccontacto',
    						'distrito',
    						'twitter',
    						'provincia',
    						'departamento',
    						'pais',
                            'notas'
    						];
}