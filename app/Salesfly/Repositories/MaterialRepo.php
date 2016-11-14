<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Material;

class MaterialRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new Material;
    }

    public function search($q)
    {
        $materials =Material::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $materials;
    }
} 