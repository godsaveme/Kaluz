<?php
namespace Salesfly\Salesfly\Entities;

class Cash extends \Eloquent {

	protected $table = 'cashes';
    
    protected $fillable = ['fechaInicio',
    						'fechaFin',
    						'montoInicial',
    						'ingresos',
    						'gastos',
    						'montoBruto',
    						'montoReal',
    						'descuadre',
    						'estado',
    						'notas',
    						'cashHeader_id',
                            'user_id'];
}