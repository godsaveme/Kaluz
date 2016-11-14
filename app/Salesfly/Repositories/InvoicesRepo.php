<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Invoices;

class InvoicesRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Invoices;
    }
}