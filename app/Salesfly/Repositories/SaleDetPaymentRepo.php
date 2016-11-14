<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SaleDetPayment;

class SaleDetPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SaleDetPayment;
    }

    public function search($q)
    {
        $saleDetPayment =SaleDetPayment::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(5);
        return $saleDetPayment;
    }
    public function searchDetalle($id)
    {
        $salePayment =SaleDetPayment::leftjoin("detCash","detCash.id","=","saledetPayments.detCash_id")
                        ->leftjoin("cashes","cashes.id","=","detCash.cash_id")
                        ->leftjoin("cashHeaders","cashHeaders.id","=","cashes.cashHeader_id")
                        ->select('saledetPayments.*','cashHeaders.id as cashHeaders_id')
                        ->with('saleMethodPayment')
                        ->where('salePayment_id','=', $id.'%');
                        //->select('salePayments.*','cashHeaders.id')
                    //with(['customer','employee'])
                    
        return $salePayment->paginate(500);
    }
    public function mostrarDetPayment($id)
    {
        $saleDetPayment =SaleDetPayment::with('saleMethodPayment')
                        ->leftjoin("detCash","detCash.id","=","saledetPayments.detCash_id")
                        ->leftjoin("cashHeaders","cashHeaders.id","=","detCash.cash_id")
                        ->select('saledetPayments.*','cashHeaders.id as ddd')
                        ->where('salePayment_id','=', $id)
                    //with(['customer','employee'])
                    ->paginate(5);
        return $saleDetPayment;
    }
    public function paginate($count){
        $cashMonthlys = SaleDetPayment::with('saleMethodPayment')
                            ->leftjoin("detCash","detCash.id","=","saledetPayments.detCash_id")
                        ->leftjoin("cashHeaders","cashHeaders.id","=","detCash.cash_id")
                        ->select('saledetPayments.*','cashHeaders.id as ddd');
                            //->where('salePayment_id','=', '6');
        return $cashMonthlys->paginate($count);
    }
    

} 