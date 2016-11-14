<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Warehouse;

class WarehouseRepo extends BaseRepo{
    public function getModel()
    {
        return new Warehouse;
    }

    public function search($q)
    {
        $warehouses =Warehouse::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $warehouses;
    }
    public function searchWarehouse($q,$id)
    {
        $warehouses =Warehouse::select('id','nombre','shortname','capacidad')
                    ->where('nombre','like', $q.'%')->where('store_id','=',$id)
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $warehouses;
    }
    public function searchWere($q)
    {
        $warehouses =Warehouse::where('store_id','=',$q)
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $warehouses;
    }
    public function traerAlmacenporUsuario(){
        $warehouses =Warehouse::join('stores','stores.id','=','warehouses.store_id')
                       ->join('users','users.store_id','=','stores.id')
                       ->where('users.id','=',auth()->user()->id)
                       ->select('warehouses.*')->groupBy('warehouses.id')->get();
        return $warehouses;
    }
    public function paginaterepo($c){
        $warehouses = Warehouse::with('store')->paginate($c);
        $warehouses = Warehouse::with(array('store'=>function($query){
            $query->select('id','nombreTienda');
        }))->paginate($c);
        return $warehouses;
    }
}