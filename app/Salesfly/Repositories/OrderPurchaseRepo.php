<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\OrderPurchase;

class OrderPurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new OrderPurchase;
    }

    public function search($q)
    {   
         $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('suppliers.empresa','like',$q.'%')
                       ->orWhere('warehouses.nombre','like',$q.'%')
                       ->orWhere('orderPurchases.fechaPedido','like','%'.$q.'%')
                       ->orWhere('orderPurchases.fechaPrevista','like','%'.$q.'%')
                       ->paginate(15);
        
        return $purchases;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public function paginar(){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.id as supID','suppliers.empresa as empresa','warehouses.nombre as almacen')->orderBy('orderPurchases.id','dsc')
                       ->paginate(15);
        return $purchases;
   }
   public function searchEstados($estado){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')->where('orderPurchases.Estado','=',$estado)
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(15);
        return $purchases;
   }
    public function traerSumplier($id){
        $orderPurchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
        ->where('suppliers.id','=',$id)->select('suppliers.empresa as empresa')->first();
        return $orderPurchases;
    }
   public function searchFechas($fechaini,$fechafin){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       //->between('orderPurchases.fechaPedido',[$estado)
                       ->whereBetween("orderPurchases.fechaPedido",[$fechaini,$fechafin])
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(15);
        return $purchases;
   }
   public function searchFechasEstado($fechaini,$fechafin,$estado){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('orderPurchases.Estado',$estado)
                       ->whereBetween("orderPurchases.fechaPedido",[$fechaini,$fechafin])
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(15);
        return $purchases;
   }
   public function searchFechasLlegada($fechaini,$fechafin){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       //->between('orderPurchases.fechaPedido',[$estado)
                       ->whereBetween("orderPurchases.fechaPrevista",[$fechaini,$fechafin])
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(15);
        return $purchases;
   }
   public function searchFechasLlegadaEstado($fechaini,$fechafin,$estado){
    $purchases=OrderPurchase::join('suppliers','orderPurchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','orderPurchases.warehouses_id')
                       ->select('orderPurchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('orderPurchases.Estado',$estado)
                       ->whereBetween("orderPurchases.fechaPrevista",[$fechaini,$fechafin])
                       ->orderBy('orderPurchases.id','asc')
                       ->paginate(15);
        return $purchases;
   }
    
} 