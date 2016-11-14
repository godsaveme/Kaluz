<?php

namespace Salesfly\Salesfly\Managers;

class VariantManager extends BaseManager{

    public function getRules(){
        $rules = [
            'codigo' => 'required',
            'sku' => 'required|unique:variants,sku,'.$this->entity->id,
            'suppPri' => 'between:0,99999.99',
            'markup' => 'between:0,99999.99',
            'price' => 'between:0,99999.99',
            'track' => 'required|boolean',
            'product_id' => 'required|integer',
            /*'observado' => 'boolean',*/
            'estado'=>'',
            'nota' => '',
            'image' => '',
            'category' => 'integer',
            'favorite'=>'boolean',
            'user_id' => 'required|integer'
        ];
        return $rules;
    }
}

//si la variante viene de un prod sin variantes el codigo no es required,
//si la variante viene de un prod con variante el codigo es required. para hacerlo.