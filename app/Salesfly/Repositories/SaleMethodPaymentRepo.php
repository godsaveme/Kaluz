<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SaleMethodPayment;

class SaleMethodPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new SaleMethodPayment;
    }

    public function search($q)
    {
        $saleMethodPayment =SaleMethodPayment::where('tipo','=', $q)
                    //with(['customer','employee'])
                    ->paginate(15);
        return $saleMethodPayment;
    }

} 