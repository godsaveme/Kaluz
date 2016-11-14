<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetailPurchase;

class DetailPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new DetailPurchase;
    }


    //function validateDate($date, $format = 'Y-m-d')
    //{
      //  $d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
    //}
    public function paginate($id){
      $detailpurchase=DetailPurchase::join("detPres","detPres.id","=","detailPurchases.detPres_id")
      ->join("variants","variants.id","=","detPres.variant_id")
      ->join("products","products.id","=","variants.product_id")
      ->select('detailPurchases.*',"variants.sku as CodigoPCompra","products.nombre as nombre")->where("detailPurchases.purchases_id","=",$id)
      ->paginate(1000);
      return $detailpurchase;
    }
    public function Eliminar($id){
     $detailpurchase=DetailPurchase::select("*")->where("detailPurchases.purchases_id","=",$id)
     ->get();
     return $detailpurchase;
    }
  

    //public function Delete($)
}