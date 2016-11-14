<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Employeecost;

class EmployeecostRepo extends BaseRepo{
    public function getModel()
    {
        return new Employeecost;
    }
    public function mostrarCostos($id){
    	$employeecost = Employeecost::where('employee_id','=',$id)->first();
    	return $employeecost;
    }
} 