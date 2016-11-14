<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\MethodPayment;

class MethodPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new MethodPayment;
    }

   
}