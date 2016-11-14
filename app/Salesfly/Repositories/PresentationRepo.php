<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Presentation;

class PresentationRepo extends BaseRepo{
    public function getModel()
    {
        return new Presentation;
    }
    public function all(){
        return Presentation::with(['equivFin' => function ($query) {
            $query->join('presentation','presentation.id','=','equiv.preBase_id')
                    //->select('presentation.shortname','equiv.cant')->get();
                    ;
        }])->get();
    }
        public function select($id){
         $presentations=Presentation::leftjoin('equiv','equiv.preBase_id','=','presentation.id')
                                   ->where('presentation.id','=',$id)
                                   ->select('presentation.shortname')->first();
        return $presentations;
    }
    public function all_base(){
        return Presentation::where('base',1)->get();
    }

    public function all_by_base($id){
       /* return Presentation::with(['equivBase' => function ($query) {
            $query->join('presentation','presentation.id','=','equiv.preFin_id')
                //->select('shortname','cant');
            ;
        }])->where('presentation.id',$id)->get();*/
        return Presentation::join('equiv','presentation.id','=','equiv.preFin_id')
                            ->where('base',0)
                            ->where('equiv.preBase_id',$id)
                            ->get();
    }
}