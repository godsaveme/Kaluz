<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Store;

class StoreRepo extends BaseRepo{
    
    public function getModel()
    {
        return new Store;
    }

    public function search($q)
    {
        $stores =Store::where('nombreTienda','like', $q.'%')
                    ->where('id','=',auth()->user()->store_id)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $stores;
    }

    public function searchReport($q)
    {
        $stores =Store::select('id','nombreTienda','direccion','distrito','provincia','departamento')
                                ->where('nombreTienda','like', $q.'%')

                    //with(['customer','employee'])
                    ->paginate(15);
        return $stores;
    }
    public function all2(){
        //$stores = $this->storeRepo->all();
        //return response()->json($stores); 
        $stores =Store::get();
        //$stores = Store::where('stores.id','=',auth()->user()->store_id)->all();
        return $stores;
    }
    public function all(){
        //$stores = $this->storeRepo->all();
        //return response()->json($stores); 
        $stores =Store::join('warehouses','warehouses.store_id','=','stores.id')
        ->select('stores.*','warehouses.id as idW')
        ->where('stores.id','=',auth()->user()->store_id)
                     
                    //with(['customer','employee'])
                    ->get();
        //$stores = Store::where('stores.id','=',auth()->user()->store_id)->all();
        return $stores;
    }
    
} 