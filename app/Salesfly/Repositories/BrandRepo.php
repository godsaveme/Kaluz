<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Brand;

class BrandRepo extends BaseRepo{
    public function getModel()
    {
        return new Brand;
    }

    public function search($q)
    {
        $brands =Brand::where('nombre','like', $q.'%')
                    ->orWhere('shortname','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function validarNoRepit($text){
        $brands =Brand::where('nombre','=', $text)
                    ->orWhere('shortname','=', $text)
                    //->with(['customer','employee'])
                    ->first();
        return $brands;
    }
    public function paraFiltro(){
        $brands =Brand::select('nombre as value','nombre as label')->get();
                    //->with(['customer','employee'])
                    
        return $brands;
    }
}