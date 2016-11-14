<?php
namespace Salesfly\Salesfly\Managers;
class WarehouseManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required',
            'shortname'=> 'required',
            'descripcion'=> '',
            'capacidad'=>'',
            'store_id'=>''
                  ];
        return $rules;
    }}