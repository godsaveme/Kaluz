<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SeparateSale;

class SeparateSaleRepo extends BaseRepo{

    protected $q;
    
    public function getModel()
    {
        
        return new SeparateSale;
    }
    public function search($q,$x)
    {

        $this->q = $q;

        if($x == 0){
            $x = [1,2];
        }elseif($x == 1){
            $x = [1];
        }elseif($x == 2){
            $x = [2];
        }else{
            $x = [0];
        }

        if($this->q == ' ') $this->q = '%';

        //var_dump($x);
        //var_dump($q); die();

        $separate = SeparateSale::leftjoin('salePayments','salePayments.separateSale_id','=','separateSales.id')
            ->join('detSeparateSales','detSeparateSales.separateSale_id','=','separateSales.id')
            ->leftjoin('detPres','detPres.id','=','detSeparateSales.detPre_id')
            ->leftjoin('variants','variants.id','=','detPres.variant_id')
            ->leftjoin('products','products.id','=','variants.product_id')
            ->leftjoin('customers','separateSales.customer_id','=','customers.id')
            ->select('separateSales.*','salePayments.estado as estadoPago')
            ->with('customer','employee')
            ->where(function($query) {
                //$q = $this->q;
                $query->orWhere('separateSales.fechaPedido', 'like', $this->q . '%')
                    ->orWhere('customers.nombres', 'like', $this->q . '%')
                    ->orWhere('customers.apellidos', 'like', $this->q . '%')
                    ->orWhere('customers.empresa', 'like', $this->q . '%')
                    ->orWhere('products.codigo','like',$this->q . '%');
                    })
            ->whereIn('separateSales.tipo',$x)
            ->groupBy('separateSales.id')
            ->orderBy('separateSales.id','DESC')
            ->paginate(15);
        return $separate;
    }
    public function paginate($count){
        $separate = SeparateSale::leftjoin('salePayments','salePayments.separateSale_id','=','separateSales.id')
                        ->select('separateSales.*','salePayments.estado as estadoPago')
                        ->with('customer','employee')
                        ->orderBy('separateSales.id','DESC');
        return $separate->paginate($count);
    }
    public function find($id)
    {
        $separate = SeparateSale::with('customer','employee');
        return $separate->find($id);
    }
    
} 