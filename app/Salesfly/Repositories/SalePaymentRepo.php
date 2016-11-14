<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SalePayment;

class SalePaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SalePayment;
    }

    public function search($q)
    {
        $salePayment =SalePayment::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }

   /* public function searchPayment($id)
    {
        $salePayment =SalePayment::with('customer')
                        ->where('sale_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }*/
  public function searchPayment($id)
    {
        $salePayment =SalePayment::leftjoin('customers','customers.id','=','salePayments.customer_id')
                                 ->join('sales','sales.id','=','salePayments.sale_id')
                                 ->leftjoin('headInvoices as hi','hi.venta_id','=','sales.id')
                                 ->select(\DB::raw("salePayments.id as idPAY,salePayments.*,customers.*,hi.tipoDoc,
                            IF(hi.numero<10,CONCAT('000000',hi.numero),
                             IF(hi.numero<100,CONCAT('00000',hi.numero),
                             IF(hi.numero<1000,CONCAT('0000',hi.numero),
                             IF(hi.numero<10000,CONCAT('000',hi.numero),
                             IF(hi.numero<100000,CONCAT('00',hi.numero),
                             IF(hi.numero<100000,CONCAT('0',hi.numero),hi.numero
                             ))))))as NumDocument"))
                                 ->where('sale_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }
    public function searchPaymentOrder($id)
    {
        $salePayment =SalePayment::with('customer')
                        ->where('orderSale_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }
    public function searchPaymentSeparate($id)
    {
        $salePayment =SalePayment::with('customer')
                        ->where('separateSale_id','=', $id.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $salePayment;
    }

    public function paginate($count){
        $Sales = Sale::with('customer');
        return $Sales->paginate($count);
    }

} 