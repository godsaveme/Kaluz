<?php

/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:04 PM
 */

namespace Salesfly\Salesfly\Managers;


class DetPresManager extends BaseManager{

    public function getRules(){
        return ['variant_id' => 'required|integer',
                'presentation_id' => 'required|integer',
                'suppPri' => 'required|between:0,99999999.99', //para que agregue decimales
                'markup' => 'required',
                'price' => 'required',
                'dscto' => 'required',
                'dsctoCant' => 'required',
                'pvp' => 'required',

                ];
    }

} 