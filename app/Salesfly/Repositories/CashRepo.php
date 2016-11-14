<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Cash;

class CashRepo extends BaseRepo{
    protected $q;
    public function getModel()
    {
        
        return new Cash;
    }

    public function search($q)
    {
        $this->q = $q;

        /*if($q==0){
            $q='%%';
        }*/
        $cashes =Cash::join("users","users.id","=","cashes.user_id")
                    ->join("cashHeaders","cashHeaders.id","=","cashes.cashHeader_id")
                    ->select(\DB::raw("cashes.*,cashes.estado as estado1,users.name as nomUser,
                                CONCAT((SUBSTRING(cashes.fechaInicio,9,2)),'-',
                                (SUBSTRING(cashes.fechaInicio,6,2)),'-',
                                (SUBSTRING(cashes.fechaInicio,1,4)))as fechainicio2,
                            CONCAT((SUBSTRING(cashes.fechaFin,9,2)),'-',
                                (SUBSTRING(cashes.fechaFin,6,2)),'-',
                                (SUBSTRING(cashes.fechaFin,1,4)))as fechafin2"))
            ->where(function($query) {

                $query->orWhere('cashes.cashHeader_id', 'like', $this->q . '%')
                    ->orWhere('users.name', 'like', $this->q . '%')
                    ->orWhere('cashes.fechainicio', 'like', '%' . $this->q . '%')
                    ->orWhere('cashes.fechafin', 'like', '%' . $this->q . '%');
                    })
                    //with(['customer','employee'])
                    ->orderby('cashes.fechaInicio','DESC')
                    ->paginate(15);
        return $cashes;
    }
    public function paginate2()
    {
        
        $cashes =Cash::join("users","users.id","=","cashes.user_id")
                    ->join("cashHeaders","cashHeaders.id","=","cashes.cashHeader_id")
                    ->select(\DB::raw("cashes.*,cashes.estado as estado1,users.name as nomUser,
                                CONCAT((SUBSTRING(cashes.fechaInicio,9,2)),'-',
                                (SUBSTRING(cashes.fechaInicio,6,2)),'-',
                                (SUBSTRING(cashes.fechaInicio,1,4)))as fechainicio2,
                            CONCAT((SUBSTRING(cashes.fechaFin,9,2)),'-',
                                (SUBSTRING(cashes.fechaFin,6,2)),'-',
                                (SUBSTRING(cashes.fechaFin,1,4)))as fechafin2"))
                    //with(['customer','employee'])
                        ->orderby('cashes.fechaInicio','DESC')
                    ->paginate(15);
        return $cashes;
    }
    
     public function searchuserincaja($id){
        $cashes =Cash::where('user_id','=', $id)
                     ->where('estado','=',1)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }
        public function id2($id){
           
        $cashes =Cash::join("cashHeaders","cashHeaders.id","=","cashes.cashHeader_id")
                     ->select("cashHeaders.id")
                     ->where('id','=', '1')
                     ->where('user_id','=',$id)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }
        public function searchuserincaja1($idCaja,$id){
           
        $cashes =Cash::select("id")
                     
                     ->where('user_id','=',$id)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }
} 