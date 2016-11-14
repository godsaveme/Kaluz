<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashMotive;

class CashMotiveRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new CashMotive;
    }

    public function search($q)
    {
        $cashMotives =CashMotive::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $cashMotives;
    }
    public function searchMotive($q)
    {
        $cashMotive =CashMotive::where('id','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $cashMotive;
    }

} 