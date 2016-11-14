<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Sale;

class SaleRepo extends BaseRepo{

    protected $q;
    
    public function getModel()
    {
        
        return new Sale;
    }

    public function search($q)
    {

        $this->q = $q;

        $sale =Sale::leftjoin('salePayments','salePayments.sale_id','=','sales.id')
                    //->join('detSeparateSales','detSeparateSales.separateSale_id','=','separateSales.id')
                    ->leftjoin('detSales','detSales.sale_id','=','sales.id')
                    ->leftjoin('detPres','detPres.id','=','detSales.detPre_id')
                    ->leftjoin('variants','variants.id','=','detPres.variant_id')
                    ->leftjoin('products','products.id','=','variants.product_id')
                    ->leftjoin('customers','sales.customer_id','=','customers.id')
                    ->select('sales.*','salePayments.estado as estadoPago')
                    ->orderBy('sales.id','DESC')
                    //->groupBy('')
                    ->with('customer','employee')
                    //->get()
                    ->where(function($query) {
                        //$q = $this->q;
                        $query->orWhere('sales.fechaPedido', 'like', $this->q . '%')
                            ->orWhere('customers.nombres', 'like', $this->q . '%')
                            ->orWhere('customers.apellidos', 'like', $this->q . '%')
                            ->orWhere('customers.empresa', 'like', $this->q . '%')
                            ->orWhere('products.codigo','like',$this->q . '%');
                    })
                    ->groupBy('sales.id')
                    ->paginate(15);
        return $sale;
    }
    public function paginate($count){
        $sale = Sale::leftjoin('salePayments','salePayments.sale_id','=','sales.id')
                        ->select('sales.*','salePayments.estado as estadoPago')
                        ->orderBy('sales.id','DESC')
                        //->groupBy('')
                        ->with('customer','employee')
                        //->get();
                        ->paginate($count);
        return $sale;
    }
    public function find($id)
    {
        $sale = Sale::with('customer','employee');
        return $sale->find($id);
    }
} 