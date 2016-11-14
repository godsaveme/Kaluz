<?php

/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:04 PM
 */

namespace Salesfly\Salesfly\Managers;


class DetAtrManager extends BaseManager{

    public function getRules(){
        return ['variant_id' => 'required|integer',
            'atribute_id' => 'required|integer',
            'descripcion' => 'required'
        ];
    }

} 