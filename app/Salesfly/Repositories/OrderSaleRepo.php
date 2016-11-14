<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\OrderSale;

class OrderSaleRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new OrderSale;
    }
    public function search($q)
    {
        $sale =OrderSale::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $sale;
    }
    public function paginate($count){
        $sale = OrderSale::leftjoin('salePayments','salePayments.orderSale_id','=','orderSales.id')
                        ->select('orderSales.*','salePayments.estado as estadoPago')
                        ->with('customer','employee');
        return $sale->paginate($count);
    }
    public function find($id)
    {
        $sale = OrderSale::with('customer','employee');
        return $sale->find($id);
    }
    
} 