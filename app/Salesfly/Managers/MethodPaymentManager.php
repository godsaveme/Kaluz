<?php
namespace Salesfly\Salesfly\Managers;
class MethodPaymentManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=>'',
            'descripcion'=>''
                  ];
        return $rules;
    }}