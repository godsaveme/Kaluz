<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\HeadInvoice;

class HeadInvoiceRepo extends BaseRepo{
    public function getModel()
    {
        return new HeadInvoice;
    }

    public function consult($id){
    	$headInvoice=HeadInvoice::where("headInvoices.id","=",$id)->first();
    	return $headInvoice;
    }
     public function DatosDocumento($id){
         $headInvoice=HeadInvoice::join("sales","sales.id","=","headInvoices.venta_id")
                                 ->leftjoin("customers","customers.id","=","headInvoices.cliente_id")
                                 ->leftjoin("employees","employees.id","=","sales.employee_id")
                                 ->join("detCash","detCash.id","=","sales.detCash_id")
                                 ->join("cashes","cashes.id","=","detCash.cash_id")
                                 ->join("cashHeaders","cashHeaders.id","=","cashes.cashHeader_id")
                                 ->join("stores","stores.id","=","cashHeaders.store_id")
                                 //idFactura,vuelto,caja,cajDid,tipo,descuento
                                 ->select(\DB::raw("headInvoices.*,sales.descuento,cashes.id as idCaja,cashes.cashHeader_id,stores.ruc as rucTienda,
                                 	headInvoices.id as idFactura, IF(employees.id>0,CONCAT(employees.nombres,' ',employees.apellidos),'.....') as nomEmpleado,cashes.id as cajDid,headInvoices.tipoDoc as tipo,cashHeaders.id as caja,
                                 	 IF(headInvoices.numero<10,CONCAT('000000',headInvoices.numero),
                             IF(headInvoices.numero<100,CONCAT('00000',headInvoices.numero),
                             IF(headInvoices.numero<1000,CONCAT('0000',headInvoices.numero),
                             IF(headInvoices.numero<10000,CONCAT('000',headInvoices.numero),
                             IF(headInvoices.numero<100000,CONCAT('00',headInvoices.numero),
                             IF(headInvoices.numero<100000,CONCAT('0',headInvoices.numero),headInvoices.numero
                             ))))))as NumDocument"))
                                 ->where("headInvoices.id","=",$id)
    	                      ->first();
    	return $headInvoice;
    }
}