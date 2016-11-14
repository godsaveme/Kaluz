<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Atribut;
use Salesfly\Salesfly\Entities\DetPres;
class AtributRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Atribut;
    }

    public function search($q)
    {
        $atributes =Atribut::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $atributes;
    }
    public function eligirNumero($id,$tama){
        $detPres=Atribut::join("detAtr","detAtr.atribute_id","=","atributes.id")
                           ->where("detAtr.variant_id","=",$id)->where("detAtr.descripcion","=",$tama)
                           ->select("detAtr.descripcion as decrip","atributes.nombre as name","atributes.shortname as nomCorto")->first();

        return $detPres;
    }
} 