<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\FBnumber;

class FBnumberRepo extends BaseRepo{
    public function getModel()
    {
        return new FBnumber;
    }
    public function getserie($id){
       $number=FBnumber::where("caja_id","=",$id)->first();
       return $number;
    }
    public function numeracion($tipo,$id){
    	if($tipo=="F"){
    	      $number=FBnumber::select("numFactura")->where("caja_id","=",$id)->first();
        }else{
              $number=FBnumber::select("numBoleta")->where("caja_id","=",$id)->first();
        }
        return $number;
    }
}