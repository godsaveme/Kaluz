<?php

namespace Salesfly\Salesfly\Managers;
class TypeManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                     'nombre'=> 'required',
            'shortname'=>'required',
            'descripcion'=>''
                  ];
        return $rules;
    }
} 
