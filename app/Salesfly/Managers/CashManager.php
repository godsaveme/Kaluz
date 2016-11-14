<?php

namespace Salesfly\Salesfly\Managers;

class CashManager extends BaseManager{

    public function getRules(){
        $rules = [
            'fechaInicio' => 'required',
            'fechaFin' => '',
            'montoInicial' => 'required',
            'ingresos' => '',
            'gastos' => '',
            'montoBruto' => '',
            'montoReal' => '',
            'descuadre' => '',
            'estado' => 'required',
            'notas' => '',
            'cashHeader_id' => 'required',
            'user_id'=>'required'
        ];
        return $rules;
    }
}