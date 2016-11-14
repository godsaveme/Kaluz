<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Supplier;

class SupplierRepo extends BaseRepo{
    public function getModel()
    {
        return new Supplier;
    }

    public function search($q)
    {
        $supplier =Supplier::where('nombres','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $supplier;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public function deudas (){ 
         $supplier =Supplier::leftjoin("payments","payments.supplier_id","=","suppliers.id")
                            ->select(\DB::raw('suppliers.id as idsup,suppliers.*,(SELECT sum(payments.Saldo)
                                     FROM payments
                                     INNER JOIN suppliers ON suppliers.id = payments.supplier_id
                                     WHERE suppliers.id = idsup and payments.Saldo>0 group By suppliers.id) as deuda'))
                            ->groupBy("suppliers.id")
                            ->paginate(15);
        return $supplier;
    }
} 