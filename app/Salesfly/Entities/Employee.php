<?php
namespace Salesfly\Salesfly\Entities;

class Employee extends \Eloquent {

	protected $table = 'employees';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'codigo',
    						'fechanac',
    						'fijo',
    						'movil',
    						'email',
    						'website',
    						'imagen',
    						'genero',
    						'direccioncontacto',
    						'twitter',
    						'distrito',
    						'provincia',
    						'departamento',
    						'pais',
    						'notas',
                            'estado',
                            'dni',
							'cargo'
    						];
}