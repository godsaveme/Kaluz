<?php
namespace Salesfly\Salesfly\Managers;
class ActivatorPromotionManager extends BaseManager {

    public function getRules()
    {
        $rules = ['fechaPedido'=> '',
    				'fechaPrevista'=>'',
    				'cantidad'=> '',
    				'promotion_id'=> ''];
        return $rules;
    }
}