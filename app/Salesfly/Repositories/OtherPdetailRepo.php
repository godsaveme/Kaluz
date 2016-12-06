<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\OtherPdetail;

class OtherPdetailRepo extends BaseRepo{
    public function getModel()
    {
        return new OtherPdetail;
    }

    public function search($q)
    {
        $brands =OtherPdetail::where('nombre','like', $q.'%')
                    ->orWhere('shortname','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function validarNoRepit($text){
        $OtherPdetail =OtherPdetail::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $OtherPdetail;
    }
    public function datos($id){
           $otherPdetail =OtherPdetail::where('otherPhead_id','=', $id)
                    //->with(['customer','employee'])
                    ->paginate(50);
        return $otherPdetail;
    }
}