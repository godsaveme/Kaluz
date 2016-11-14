<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashMonthly;


class CashMonthlyRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new CashMonthly;
    }

    public function search($m,$a,$c)
    { 
        /*if($m==0){
            $m='%%';
        }*/
        //return $m;  
        if($c==0){
            $c='%%';
        }
        if($a!=0 && $m!=0){
            $CashMonthlys =CashMonthly::with('expenseMonthly')
                    //->where('months_id','like',$m)
                    //->where('fecha','between',$a )
                    ->whereBetween('fecha', [$m,$a])
                    ->where('expenseMonthlys_id','like',$c)  
                    ->paginate(15); 
            return $CashMonthlys;
        }else{
            $CashMonthlys =CashMonthly::with('expenseMonthly')
                    //->where('months_id','like',$m)
                    //->where('fecha','between',$a )
                    //->whereBetween('fecha', [$m,$a])
                    ->where('expenseMonthlys_id','like',$c)  
                    ->paginate(15); 
            return $CashMonthlys;        
        }
        
            
    }

    public function searchMonto($m,$a,$c)
    { 
        /*if($m==0){
            $m='%%';
        }*/
        //return $m;  
        if($c==0){
            $c='%%';
        }
        if($a!=0 && $m!=0){
            $CashMonthlys =CashMonthly::whereBetween('fecha', [$m,$a])
                    ->where('expenseMonthlys_id','like',$c)
                    ->select(\DB::raw('SUM(amount) as monto'));
                    //->groupBy('amount');
                    //->paginate(15); 

            return $CashMonthlys->get();
        }else{
            $CashMonthlys =CashMonthly::where('expenseMonthlys_id','like',$c)
                            ->select(\DB::raw('SUM(amount) as monto')); 
            return $CashMonthlys->get();        
        }
        
            
    }

    //public function store()
    //{
     //   return $this->belongsTo('\Salesfly\Salesfly\Entities\Month');
    //}

    public function paginate($count){
        $cashMonthlys = CashMonthly::with('expenseMonthly');
        return $cashMonthlys->paginate($count);
    }
    function validateDate($date, $format = 'Y-M-D H:M:S')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
} 