<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Stock;

class StockRepo extends BaseRepo{
    
    public function getModel()
    {
        return new Stock;
    }


    public function search($q)
    {
        $stock =Stock::where('direccion','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $stock;
    }
   /*public function traerStock($id,$id2){
    $stock=Stock::where('warehouse_id','=',$id)->where('variant_id','=',$id2)->first();
    return $stock;
   }*/
   public function encontrar($vari,$almacen){
        $stocks=Stock::where("variant_id","=",$vari)->where("warehouse_id","=",$almacen)->first();
        return $stocks;
    }
    
} 