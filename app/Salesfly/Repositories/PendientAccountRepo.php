<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\PendientAccount;

class PendientAccountRepo extends BaseRepo{
    public function getModel()
    {
        return new PendientAccount;
    }

    public function search($q)
    {
        $brands =PendientAccount::where('nombre','like', $q.'%')
                    //->with(['customer','employee'])
                    ->paginate(15);
        return $brands;
    }
    public function verSaldos($id){
        $pendientAccount=PendientAccount::where('supplier_id','=',$id)->where('estado','=',0)
                                          ->get();
         return $pendientAccount;
    }
    public function find1($id){
        $pendientAccount=PendientAccount::where('supplier_id','=',$id)
                                          ->first();
         return $pendientAccount;
    }
    public function find2($id){
         $pendientAccount=PendientAccount::where("pendientAccounts.id","=",$id)->where("pendientAccounts.estado","=",0)->first();
       return $pendientAccount;
    }
    public function paginar(){
    	$pendientAccount=PendientAccount::join("suppliers","suppliers.id","=","pendientAccounts.supplier_id")
    	                                  ->select("pendientAccounts.*","suppliers.empresa")
    	                                  ->paginate(15);
    	return $pendientAccount;
    }
    public function verSaldosTotales($prov){
    	$pendientAccount=PendientAccount::where("pendientAccounts.supplier_id","=",$prov)->where("pendientAccounts.estado","=",0)
    	                                  ->select(\DB::raw("SUM(Saldo) as total"))->first();
    	return $pendientAccount;
    }
}