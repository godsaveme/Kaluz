<?php

namespace Salesfly\Salesfly\Managers;

class CashMotiveManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => 'required',
            'observacion' => '',
            'tipo' => 'required'
        ];
        return $rules;
    }
}