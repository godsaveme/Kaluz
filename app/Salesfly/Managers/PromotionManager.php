<?php
namespace Salesfly\Salesfly\Managers;
class PromotionManager extends BaseManager {

    public function getRules()
    {
        $rules = ['nombre'=> 'required',
    				'multiplicador'=>'required',
    				'descripcion'=> '',
    				'cantidad'=> ''];
        return $rules;
    }
}