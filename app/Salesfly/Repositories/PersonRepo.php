<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Person;

class PersonRepo extends BaseRepo{
    public function getModel()
    {
        return new Person;
    }

    public function search($q)
    {
        $persons =Person::where('dni','like', $q.'%')
                    ->orWhere('nombres','like',$q.'%')
                    ->orWhere('razonSocial','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $persons;
    }
} 