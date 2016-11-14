<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:22 PM
 */

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Equiv;

class EquivRepo extends BaseRepo{
    public function getModel(){
        return new Equiv;
    }
   public function select($id){

   	   $equivs=Equiv::select("cant")->where("preFin_id","=",$id)->get();
   	   return $equivs;
   
} 
}
