<?php

namespace Salesfly\Salesfly\Managers;
class EmployeeManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                            'nombres'=>'required',
                            'apellidos'=>'required',
                            'codigo'=>'required|unique:employees,codigo,'.$this->entity->id,
                            'fechanac'=>'',
                            'fijo'=>'',
                            'movil'=>'',
                            'email'=>'',
                            'website'=>'',
                            'imagen'=>'',
                            'genero'=>'',
                            'direccioncontacto'=>'',
                            'twitter'=>'',
                            'distrito'=>'',
                            'provincia'=>'',
                            'departamento'=>'',
                            'pais'=>'',
                            'notas'=>'',
                            'estado'=>'',
                            'dni'=>'required|unique:employees,dni,'.$this->entity->id,
                            'cargo' => ''
                  ];
        return $rules;
    }
} 
