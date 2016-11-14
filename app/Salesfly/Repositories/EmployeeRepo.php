<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Employee;

class EmployeeRepo extends BaseRepo{
    public function getModel()
    {
        return new Employee;
    }

    public function search($q)
    {
        $customers =Employee::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $customers;
    }
    public function searchVenta($q)
    {
        $employee =Employee::select(\DB::raw('id,nombres,apellidos,estado,codigo,CONCAT(nombres,"-",apellidos) as busqueda'))
                    ->where('estado','!=', 0)
                    ->where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    ->orWhere('codigo','like',$q.'%')
                    ->paginate(15);
        return $employee;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
} 