<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:29 PM
 */

namespace Salesfly\Salesfly\Repositories;


use Salesfly\Salesfly\Entities\DetPres;

class DetPresRepo extends BaseRepo{
    public function getModel(){
        return new DetPres;
    }

    public function traerDetalles($id){
         $detPres=DetPres::join("variants","variants.id","=","detPres.variant_id")
                           ->join("presentation","presentation.id","=","detPres.presentation_id")
                           ->leftJoin("equiv","equiv.preFin_id","=","presentation.id")
                           ->where("detPres.variant_id","=",$id)
                           ->select(\DB::raw("detPres.id as iddetalleP,detPres.presentation_id as presenTid,
                           	detPres.suppPri as precioCompra,presentation.*,equiv.cant as equivalencia,
                           	equiv.preBase_id as basevalor,(select (presentation.shortname) from presentation where presentation.id=basevalor) 
                           	as nomBase"))->paginate();
                    
          return  $detPres;
    }
     public function traerCodPresentation($id){
     	  $detPres=DetPres::join("presentation","presentation.id","=","detPres.presentation_id")
     	                    ->select("presentation.id as idPresentacion","presentation.base as Presenbase","detPres.variant_id as idVariante")
     	                    ->where("presentation_id","=",$id)->first();
         return  $detPres;
    }
    public function elegirunDetPres($id){
        $detPres=DetPres::join("variants","variants.id","=","detPres.variant_id")
                           ->join("presentation","presentation.id","=","detPres.presentation_id")
                           ->leftJoin("equiv","equiv.preFin_id","=","presentation.id")
                           ->where("variants.id","=",$id)->where("presentation.base","=",1)
                           ->select(\DB::raw("variants.*,detPres.id as detpresen_id,detPres.suppPri as precioProduct,
                            presentation.base as esbase"))->groupBy("detPres.id")->first();

        return $detPres;
    }
    public function listarVariantes($id){
         $detPres=DetPres::join("variants","variants.id","=","detPres.variant_id")
                          ->where("detPres.id","=",$id)->first();
          return $detPres;
    }
     
} 