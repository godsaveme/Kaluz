<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Ttype;

class TypeRepo extends BaseRepo{
    public function getModel()
    {
        return new Ttype;
    }

    public function search($q)
    {
        $types =Ttype::where('nombre','like', $q.'%')
                    
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $types;
    }
    public function searchType($q)
    {
        $types =Ttype::select('id','nombre')
                    ->get();
        return $types;
    }
     public function paraFiltroTypes(){
        $type =Ttype::select('nombre as value','nombre as label')->get();
                    //->with(['customer','employee'])
                    
        return $type;
    }
} 