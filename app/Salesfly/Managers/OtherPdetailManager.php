<?php
namespace Salesfly\Salesfly\Managers;
class OtherPdetailManager extends BaseManager {

    public function getRules()
    {
        $rules = [         'cantidad'=>'',
                           'descripcion'=>'',
                           'PrecioUnit'=>'',
                           'PrecioFinal'=>'',
                           'otherPhead_id'=>''];
        return $rules;
    }}