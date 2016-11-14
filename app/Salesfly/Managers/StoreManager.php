<?php

namespace Salesfly\Salesfly\Managers;
class StoreManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombreTienda'=>'required',
                    'razonSocial'=>'required',
                    'ruc'=>'required',
                    'direccion'=>'required',
                    'distrito'=>'',
                    'provincia'=>'',
                    'departamento'=>'',
                    'pais' => '',
                    'email'=>'',
                    'website'=>''                    
                  ];
        return $rules;
    }
} 

