<?php

namespace Salesfly\Salesfly\Managers;

class PresentationManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => 'required',
            'shortname' => 'required',
            'descripcion' => ''
        ];
        return $rules;
    }
}