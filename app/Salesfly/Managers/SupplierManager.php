<?php

namespace Salesfly\Salesfly\Managers;
class SupplierManager extends BaseManager {

    public function getRules()
    {
        $rules = [  
                            'nombres'=>'required',
                            'apellidos'=>'required',
                            'empresa'=>'required',
                            'codigo'=>'required|unique:suppliers,codigo,'.$this->entity->id,
                            'direccionfiscal'=>'',
                            'ruc'=>'',
                            'dni' =>'',
                            'numcuenta'=>'',
                            'fechanac'=>'',
                            'fijo'=>'',
                            'movl'=>'',
                            'email'=>'',
                            'website'=>'',
                            'genero'=>'',
                            'direccontacto'=>'',
                            'distrito'=>'',
                            'twitter'=>'',
                            'provincia'=>'',
                            'departamento'=>'',
                            'pais'=>'',
                            'notas'=>''
                  ];
        return $rules;
    }
} 
