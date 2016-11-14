<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetPromotion;

class DetPromotionRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetPromotion;
    }

    //public function search($q)
    //{
    //    $detPromotion =DetPromotion::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
    //                ->paginate(15);
    //    return $detPromotion;
    //}
} 