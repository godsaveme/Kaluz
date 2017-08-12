<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\OtherPhead;

class OtherPheadRepo extends BaseRepo{
    public function getModel()
    {
        return new OtherPhead;
    }

    public function search($q)
    {
        $brands =OtherPhead::where('proveedor','like', $q.'%')
                    ->orWhere('ruc','like',$q.'%')
                    ->orWhere('numeroDocumento','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function validarNoRepit($text){
        $brands =OtherPhead::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $brands;
    }
}