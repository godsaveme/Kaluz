<?php
namespace Salesfly\Salesfly\Managers;
class CashHeaderManager extends BaseManager {

    public function getRules()
    {
        $rules = ['nombre'=> 'required',
    				'ambiente'=>'required',
    				'estado'=> 'required',
    				'descripcion'=> '',
    				'store_id'=> 'required'];
        return $rules;
    }
}