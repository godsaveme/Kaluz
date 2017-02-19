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
                    ->where('cashHeaders.store_id','=',auth()->user()->store_id)
            ->where(function($query) {

                $query
                     ->orWhere('cashes.cashHeader_id', 'like', $this->q . '%')
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
                                (SUBSTRING(cashes.fechaFin,1,4)))as fechafin2,
                    (SELECT IF(SUM(dc.montoMovimientoTarjeta)>0,SUM(dc.montoMovimientoTarjeta),0)
                    FROM detCash dc inner join sales s on s.detCash_id=dc.id where dc.cashMotive_id=1 
                    and s.estado = 1 and dc.cash_id=cashes.id) as totTar,
                    (SELECT IF(SUM(dc.montoMovimientoEfectivo)>0,SUM(dc.montoMovimientoEfectivo),0) 
                    FROM detCash dc inner join sales s on s.detCash_id=dc.id where dc.cashMotive_id=1 
                    and s.estado = 1 and dc.cash_id=cashes.id) as totEfect,
((SELECT IF(SUM(dc.montoMovimientoTarjeta)>0,SUM(dc.montoMovimientoTarjeta),0)
                    FROM detCash dc inner join sales s on s.detCash_id=dc.id where dc.cashMotive_id=1 
                    and s.estado = 1 and dc.cash_id=cashes.id) +
                    (SELECT IF(SUM(dc.montoMovimientoEfectivo)>0,SUM(dc.montoMovimientoEfectivo),0) 
                    FROM detCash dc inner join sales s on s.detCash_id=dc.id where dc.cashMotive_id=1 
                    and s.estado = 1 and dc.cash_id=cashes.id)) as totVentas"))
                    //with(['customer','employee'])
                    ->where('cashHeaders.store_id','=',auth()->user()->store_id)
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
                     ->where('cashHeaders.store_id','=',auth()->user()->store_id)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }
       public function searchuserincaja1($idCaja,$id){
        $cashes =Cash::where('id','=', $idCaja)
                     ->where('user_id','=',$id)
                     ->where('estado','=',1)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }

    public function findCalculado($id){
        $cashes =Cash::select(\DB::raw("cashes.*,(SELECT ifnull(sum(dc.montoMovimientoTarjeta),0) as tarjeta 
            FROM detCash dc inner join sales s on s.detCash_id=dc.id
WHERE dc.cash_id=cashes.id and s.estado <> 3) as totoTarjeta,
        (SELECT ifnull(sum(dc.montoMovimientoEfectivo),0) FROM detCash dc
inner join sales s on s.detCash_id=dc.id
WHERE dc.cash_id=cashes.id and s.estado <> 3 and cm.tipo='+')-(SELECT ifnull(sum(montoMovimientoEfectivo),0) as efectivo FROM detCash dc inner join cashMotives cm on cm.id=dc.cashMotive_id 
WHERE dc.cash_id=cashes.id and cm.tipo='-' and cm.id <> 18) as montoBruto2,(SELECT ifnull(sum(montoMovimientoEfectivo),0) as efectivo FROM detCash dc inner join cashMotives cm on cm.id=dc.cashMotive_id 
WHERE dc.cash_id=cashes.id and cm.tipo='-') as gatos2"))

                    ->where('id','=', $id)
                    //with(['customer','employee'])
                    ->first();
        return $cashes;
    }
    
     public function searchuserincaja100($idCaja,$id){
        if(auth()->user()->role_id == 1){
             $cashes =Cash::where('id','=', $idCaja)
                    //with(['customer','employee'])
                    ->first();
        }else{
              $cashes =Cash::where('id','=', $idCaja)
                     ->where('user_id','=',$id)
                    //with(['customer','employee'])
                    ->first();
        }
        return $cashes;
    }
} 