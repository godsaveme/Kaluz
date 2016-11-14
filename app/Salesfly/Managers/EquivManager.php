<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:19 PM
 */

namespace Salesfly\Salesfly\Managers;


class EquivManager extends BaseManager{
    public function getRules(){
        return ['preBase_id' => 'required|integer',
                'preFin_id' => 'required|integer',
                'cant' => 'required|between:0,99999999.99'];
    }
} 