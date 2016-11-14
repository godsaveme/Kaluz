<?php

namespace Salesfly\Salesfly\Managers;
class practicaManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombre'=>'required',
                    'apellidos'=>'required',
                    'edad' => ''
                  ];
        return $rules;
    }
} 