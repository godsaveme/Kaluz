<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Payment;

class PaymentRepo extends BaseRepo{
    public function getModel()
    {
        return new Payment;
    }

   public function paymentById($id){
       $payment=Payment::Where('payments.orderPurchase_id','=',$id)->first();
       return $payment;
   }
   public function payIDLocal($id){
       $payment=Payment::where('payments.purchase_id','=',$id)->first();
       return $payment;
   }
   
} 