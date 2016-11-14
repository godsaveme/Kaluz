<?php
namespace Salesfly\Salesfly\Entities;

class Customer extends \Eloquent {

	protected $table = 'customers';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'empresa',
    						'direccFiscal',
    						'ruc',
							'dni',
    						'codigo',
    						'fechaNac',
    						'genero',
    						'fijo',
    						'movil',
    						'email',
    						'website',
    						'direccContac',
    						'distrito',
    						'provincia',
    						'departamento',
    						'pais',
    						'notas'
    						];

}