<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\ActivatorPromotion;

class ActivatorPromotionRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new ActivatorPromotion;
    }

    //public function search($q)
    //{
    //    $detPromotion =DetPromotion::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
    //                ->paginate(15);
    //    return $detPromotion;
    //}
} 