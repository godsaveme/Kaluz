<?php

namespace Salesfly\Salesfly\Managers;
class PersonManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apPaterno'=>'required'
                  ];
        return $rules;
    }
} 

