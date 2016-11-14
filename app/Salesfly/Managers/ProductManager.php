<?php

namespace Salesfly\Salesfly\Managers;

class ProductManager extends BaseManager{

    public function getRules(){
        $rules = [
            'nombre' => '',
            'codigo' => 'required|unique:products,codigo,'.$this->entity->id,
            'suppCode' => 'required|unique:products,suppCode,'.$this->entity->id,
            'hasVariants' => 'required|boolean',
            'descripcion' => '',
            'type_id' => 'integer',
            'brand_id' => 'integer',
            'material_id' => 'integer',
            'station_id' => 'integer',
            'estado' => 'required|boolean',
            'image' => '',
            'modelo' => '',
            'presentation_base' => 'integer',
            'user_id' => 'required|integer'

        ];
        return $rules;
    }
}