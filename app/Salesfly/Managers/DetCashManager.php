<?php

namespace Salesfly\Salesfly\Managers;

class DetCashManager extends BaseManager{

    public function getRules(){
        $rules = [
            'fecha' => 'required',
            'hora' => 'required',
            'montoCaja' => 'required',
            'montoMovimientoTarjeta' => '',
            'montoMovimientoEfectivo' => '',
            'montoFinal' => 'required',
            'estado' => '',
            'observacion' => '',
            'cashMotive_id' => 'required',
            'cash_id' => 'required'           
        ];
        return $rules;
    }
}