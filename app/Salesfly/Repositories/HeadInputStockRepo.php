<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\HeadInputStock;

class HeadInputStockRepo extends BaseRepo{
    public function getModel()
    {
        return new HeadInputStock;
    }

    public function search($q)
    {
        $brands =InputStock::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function select(){
       $headInputStock=HeadInputStock::join("warehouses","warehouses.id","=","headInputStocks.warehouses_id")
                                     ->join('users','users.id','=','headInputStocks.user_id')
                            ->select(\DB::raw("headInputStocks.*,headInputStocks.warehouDestino_id as destWareh,warehouses.nombre,users.name as nombreUser ,(SELECT (warehouses.nombre ) FROM headInputStocks
                                INNER JOIN warehouses ON headInputStocks.warehouDestino_id = warehouses.id
                                where warehouses.id=destWareh
                                GROUP BY warehouses.id)as nomAlmacen2"))
                            ->groupBy("headInputStocks.id")
                            ->orderBy('headInputStocks.id', 'DESC')
                            ->paginate(15);
        return $headInputStock;
    }
     public function select2($fechaini,$fechafin){
       $headInputStock=HeadInputStock::join("warehouses","warehouses.id","=","headInputStocks.warehouses_id")
                                     ->join('users','users.id','=','headInputStocks.user_id')
                            ->select(\DB::raw("headInputStocks.*,headInputStocks.warehouDestino_id as destWareh,warehouses.nombre,users.name as nombreUser ,(SELECT (warehouses.nombre ) FROM headInputStocks
                                INNER JOIN warehouses ON headInputStocks.warehouDestino_id = warehouses.id
                                where warehouses.id=destWareh
                                GROUP BY warehouses.id)as nomAlmacen2"))
                            ->whereBetween("headInputStocks.created_at",[$fechaini,$fechafin])
                            ->groupBy("headInputStocks.id")->paginate(15);
        return $headInputStock;
    }
     public function selectporTipos($tipo){
       $headInputStock=HeadInputStock::join("warehouses","warehouses.id","=","headInputStocks.warehouses_id")
                                     ->join('users','users.id','=','headInputStocks.user_id')
                            ->select(\DB::raw("headInputStocks.*,headInputStocks.warehouDestino_id as destWareh,warehouses.nombre,users.name as nombreUser ,(SELECT (warehouses.nombre ) FROM headInputStocks
                                INNER JOIN warehouses ON headInputStocks.warehouDestino_id = warehouses.id
                                where warehouses.id=destWareh
                                GROUP BY warehouses.id)as nomAlmacen2"))
                            ->where("headInputStocks.tipo","=",$tipo)
                            ->groupBy("headInputStocks.id")->paginate(15);
        return $headInputStock;
    }
    public function selectFechaYtipo($fechaini,$fechafin,$tipo){
       $headInputStock=HeadInputStock::join("warehouses","warehouses.id","=","headInputStocks.warehouses_id")
                                     ->join('users','users.id','=','headInputStocks.user_id')
                            ->select(\DB::raw("headInputStocks.*,headInputStocks.warehouDestino_id as destWareh,warehouses.nombre,users.name as nombreUser ,(SELECT (warehouses.nombre ) FROM headInputStocks
                                INNER JOIN warehouses ON headInputStocks.warehouDestino_id = warehouses.id
                                where warehouses.id=destWareh
                                GROUP BY warehouses.id)as nomAlmacen2"))
                            ->whereBetween("headInputStocks.created_at",[$fechaini,$fechafin])
                            ->where("headInputStocks.tipo","=",$tipo)
                            ->groupBy("headInputStocks.id")->paginate(15);
        return $headInputStock;
    }
}