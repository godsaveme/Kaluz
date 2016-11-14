<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetPayment;

class DetPaymentRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetPayment;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    function mostrarDetPayment($id){
        $detPayment=DetPayment::leftjoin("detCash","detCash.id","=","detPayments.detCash_id")
            ->leftjoin("cashes","cashes.id","=","detCash.cash_id")
            ->leftjoin("cashHeaders","cashes.cashHeader_id","=","cashHeaders.id")
            ->leftjoin("methodPayments","methodPayments.id","=",
            "detPayments.methodPayment_id")->select("cashes.cashHeader_id as cashID","cashHeaders.nombre","detPayments.*",
            "methodPayments.nombre as nameMethod")->where('detPayments.payment_id','=',$id)->paginate(5);
        return $detPayment;
    }

    function verPagosAdelantados($id){
       $detPayment=DetPayment::where("detPayments.payment_id","=",$id)->get();
       return $detPayment;
    }
} 