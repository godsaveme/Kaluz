<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\CashHeader;



class CashHeaderRepo extends BaseRepo{
    
    public function getModel()
    {       
        return new CashHeader;
    }


    public function search($q)
    {
        $cashHeaders =CashHeader::with('store')->where('cashHeaders.store_id','=',auth()->user()->store_id)->where('nombre','like', $q.'%')
                    ->orWhere('ambiente','like',$q.'%')
                    //->orWhere('s','like',$q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $cashHeaders;
    }
    public function searchHeader($q)
    {
        $cashHeaders =CashHeader::where('store_id','=', $q)
                    ->get();
        return $cashHeaders;
    }

    public function comprobarCaja($id){
        $cashHeaders =CashHeader::join("cashes","cashes.cashHeader_id","=","cashHeaders.id")
                      ->where('cashes.id','=', $id)
                      ->where('cashHeaders.store_id','=',auth()->user()->store_id)
                      ->select("cashHeaders.*")
                    ->first();
        return $cashHeaders;
    }
    public function paginate($count){
        $cashHeaders = CashHeader::with('store')
        ->where('cashHeaders.store_id','=',auth()->user()->store_id);
        return $cashHeaders->paginate($count);
    }
    public function cajasActivas($alm){
        $cashHeaders =CashHeader::join('cashes','cashes.cashHeader_id','=','cashHeaders.id')
                                  ->join('stores','stores.id','=','cashHeaders.store_id')
                                  ->join('warehouses','warehouses.store_id','=','stores.id')
                                  ->where('cashes.estado','=',1)->where('warehouses.id','=',$alm)
                                  ->select('cashHeaders.*','cashes.id as cashID','cashes.montoBruto as montoUsable')
                                  ->where('cashHeaders.store_id','=',auth()->user()->store_id)
                                  ->groupBy('cashHeaders.id')
                    ->get();
        return $cashHeaders;
    }
    public function cajas(){
         $cashHeaders = CashHeader::join('cashes','cashes.cashHeader_id','=','cashHeaders.id')
                                   ->where('cashes.estado','=',1)
                                   ->select('cashHeaders.*','cashes.id as cashID','cashes.montoBruto as montoUsable')
                                   ->where('cashHeaders.store_id','=',auth()->user()->store_id)
                                   ->groupBy('cashHeaders.id')->get();
        return $cashHeaders;
    }
} 