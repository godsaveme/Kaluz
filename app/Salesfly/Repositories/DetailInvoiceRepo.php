<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetailInvoice;

class DetailInvoiceRepo extends BaseRepo{
    public function getModel()
    {
        return new DetailInvoice;
    }

    public function detFactura($id){
        $detailInvoice=DetailInvoice::where("detailInvoices.headInvoice_id","=",$id)->get();
        return $detailInvoice;
    }
}