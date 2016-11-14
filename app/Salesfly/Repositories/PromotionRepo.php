<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Promotion;

class PromotionRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Promotion;
    }

    public function search($q)
    {
        $promotion =Promotion::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $promotion;
    }
} 