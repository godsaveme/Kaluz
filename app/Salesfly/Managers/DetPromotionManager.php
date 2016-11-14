<?php
namespace Salesfly\Salesfly\Managers;
class DetPromotionManager extends BaseManager {

    public function getRules()
    {
        $rules = ['contador'=> '',
    				'activatorPromotion_id'=>'',
    				'detPre_id'=> ''];
        return $rules;
    }
}