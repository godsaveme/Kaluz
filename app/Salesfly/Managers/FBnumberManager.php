<?php

namespace Salesfly\Salesfly\Managers;
class FBnumberManager extends BaseManager {

    public function getRules()
    {
        $rules = ['numFactura'=>'','numBoleta'=>'','caja_id'=>''];
        return $rules;
    }
}