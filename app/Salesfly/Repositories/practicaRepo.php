<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\practica;

class practicaRepo extends BaseRepo{
    public function getModel()
    {
        return new practica;
    }

    public function search($q)
    {
        $practicas =practica::where('nombre','like', $q.'%')
                    ->orWhere('apellidos','like',$q.'%')
                    //->orWhere('empresa','like',$q.'%')
                    //->orWhere('ruc','like',$q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $practicas;
    }

    //function validateDate($date, $format = 'Y-m-d')
    //{
      //  $d = \DateTime::createFromFormat($format, $date);
        //return $d && $d->format($format) == $date;
    //}
} 