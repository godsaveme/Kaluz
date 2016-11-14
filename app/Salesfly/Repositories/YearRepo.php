<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Year;

class YearRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Year;
    }

    public function search($q)
    {
        $Years =Year::where('year','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $Years;
    }

    public function lists()
    {
        $years=Year::select('year','id')->get();
        return $years;
    }
    public function find($id){
        $expenseMonthly = Year::where('id','=',$id)->first();
        return $expenseMonthly;
    }
    public function findID($año){
        $year = Year::where('year','=',$año)->first();
        return $year;
    }
} 