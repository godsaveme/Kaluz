<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetailOrderPurchase;

class DetailOrderPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new DetailOrderPurchase;
    }


    //function validateDate($date, $format = 'Y-m-d')
    //{
      //  $d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
    //}
    public function paginate($id){
      $detailOrderPurchase=DetailOrderPurchase::join("detPres","detPres.id","=","detailOrderPurchases.detPres_id")
      ->join("variants","variants.id","=","detPres.variant_id")
      ->join("products","products.id","=","variants.product_id")
      ->join("presentation","presentation.id","=","detPres.presentation_id")
      ->leftjoin("equiv","equiv.preFin_id","=","presentation.id")
      ->select('detailOrderPurchases.*',"detailOrderPurchases.cantidad as cantidad1","variants.id as Codigovar","variants.sku as CodigoPCompra","products.nombre as nombre","equiv.cant as equivalencia","presentation.base as esbase")
     ->where("detailOrderPurchases.orderPurchases_id","=",$id)
      ->paginate(1000);
      return $detailOrderPurchase;
    }
    public function paginaporEstados($estado){
          $detailOrderPurchase=DetailOrderPurchase::join("detPres","detPres.id","=","detailOrderPurchases.detPres_id")
      ->join("variants","variants.id","=","detPres.variant_id")
      ->join("products","products.id","=","variants.product_id")
      ->join("orderPurchases","orderPurchases.id","=","detailOrderPurchases.orderPurchases_id")
      ->select('detailOrderPurchases.*',"variants.sku as CodigoPCompra","products.nombre as nombre")
      ->where("orderPurchases.Estado","=",$estado)
      ->paginate(15);
      return $detailOrderPurchase;

    }
    public function Eliminar($id){
     $detailOrderPurchase=DetailOrderPurchase::select("*")->where("detailOrderPurchases.purchases_id","=",$id)
     ->get();
     return $detailOrderPurchase;
    }
    public function Comprobar($idOreder){
      $detailOrderPurchase=DetailOrderPurchase::where("detailOrderPurchases.orderPurchases_id","=",$idOreder)
     ->get();
     return $detailOrderPurchase;
    }

    //public function Delete($)
}