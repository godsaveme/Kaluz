<?php
namespace Salesfly\Salesfly\Repositories; 
use Salesfly\Salesfly\Entities\Month;

class MonthRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Month;
    }

    public function search($q)
    {
        $Months =Month::where('month','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $Months;
    }

    public function lists()
    {
        $months = Month::select('month','id')->get();
        //$months = Month::lists('month','id');
        return $months;
    }
} 