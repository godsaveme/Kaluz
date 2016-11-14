<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Purchase;

class PurchaseRepo extends BaseRepo{
    public function getModel()
    {
        return new Purchase;
    }

    public function search($q)
    {
      $purchases=Purchase::join('suppliers','purchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->leftjoin('payments','payments.purchase_id','=','purchases.id')
                       ->select('purchases.*','payments.NumFactura as numdocument','payments.NumSerie as serie',
                        'payments.tipoDoc as tipoDoc','payments.Saldo as saldo','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('suppliers.empresa','like',$q.'%')
                       ->orWhere('warehouses.nombre','like',$q.'%')
                       ->orWhere('payments.NumFactura','like',$q.'%')
                       ->orWhere('purchases.fechaEntrega','like','%'.$q.'%')
                       ->orderBy('purchases.id','dsc')
                       ->paginate(15);
        
        return $purchases;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
   public function paginar($c){
    /*$purchases=Purchase::join('suppliers','purchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->leftjoin('payments','payments.purchase_id','=','purchases.id')
                       ->select('purchases.*','payments.Saldo as saldo','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->orderBy('purchases.id','dsc')
                       ->paginate($c);*/
    $purchases=Purchase::join('suppliers','purchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->leftjoin('payments','payments.purchase_id','=','purchases.id')
                       ->select('purchases.*','payments.NumFactura as numdocument','payments.NumSerie as serie',
                        'payments.tipoDoc as tipoDoc','payments.Saldo as saldo','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->orderBy('purchases.id','dsc')
                       ->paginate($c);
        return $purchases;
   }
    public function select($id){
       $purchases=Purchase::join('suppliers','purchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->select('purchases.*','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->where('purchases.id','=',$id)
                       ->first();
        return $purchases;
    }
    public function paginar1($fechaini,$fechafin){
    $purchases=Purchase::join('suppliers','purchases.supplier_id','=','suppliers.id')
                       ->join('warehouses','warehouses.id','=','purchases.warehouses_id')
                       ->leftjoin('payments','payments.purchase_id','=','purchases.id')
                       ->select('purchases.*','payments.NumFactura as numdocument','payments.NumSerie as serie',
                        'payments.tipoDoc as tipoDoc','payments.Saldo as saldo','suppliers.empresa as empresa','warehouses.nombre as almacen')
                       ->whereBetween("purchases.fechaEntrega",[$fechaini,$fechafin])
                       ->orderBy('purchases.id','dsc')
                       ->paginate(15);
        return $purchases;
   }

    
} 