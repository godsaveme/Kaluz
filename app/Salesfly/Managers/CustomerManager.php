<?php

namespace Salesfly\Salesfly\Managers;
class CustomerManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apellidos'=>'required',
                    'empresa' => '',
                    'direccFiscal' => '',
                    'ruc'=> '',
                    'dni' => '',
                    'codigo' => 'required|unique:customers,codigo,'.$this->entity->id,
                    'fechaNac' => '',
                    'genero'=> '',
                    'fijo'=> '',
                    'movil'=> '',
                    'email'=> '',
                    'website'=> '',
                    'direccContac'=> '',
                    'distrito'=> '',
                    'provincia'=> '',
                    'departamento'=> '',
                    'pais'=> '',
                    'notas'=> ''
                  ];
        return $rules;
    }
} 

