<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetSeparateSale;

class DetSeparateSaleRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetSeparateSale;
    }
/*
    public function search($q)
    {
        $detSales =DetSale::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detSales;
    }
    */
    public function searchDetalle($id) 
    {
        //$detOrders = \DB::table('detOrders')->leftjoin('detPres','detOrders.detPre_id','=','detPres.id')
        $separate =\DB::table('detSeparateSales')->leftjoin("detPres","detPres.id","=","detSeparateSales.detPre_id")
                    ->leftjoin("variants","variants.id","=","detPres.variant_id")
                    ->leftjoin("products","products.id","=","variants.product_id")
                    ->leftjoin("presentation","presentation.id","=","detPres.presentation_id")
                    ->leftjoin("equiv","equiv.preFin_id","=","presentation.id")
                    ->leftjoin("stock","stock.variant_id","=","variants.id")
                    
                    ->select(\DB::raw('detSeparateSales.*, products.nombre as nameProducto, presentation.nombre as presentacion ,variants.id as vari ,equiv.cant as equivalencia,
                            stock.stockActual as stock, stock.stockPedidos as pedidos,stock.stockSeparados as separados,
                            stock.id as idStock,variants.sku, variants.codigo,
                         (SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR " /") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id) as NombreAtributos'))

                    ->where('separateSale_id','=', $id.'%')
                             
                    //with(['customer','employee'])
                    ->paginate(15);
        return $separate;
    }

    public function listarVentasDia(){
        $detSales =\DB::table('detSeparateSales')
            ->leftjoin("detPres","detPres.id","=","detSeparateSales.detPre_id")
            ->leftjoin("variants","variants.id","=","detPres.variant_id")
            ->leftjoin("products","products.id","=","variants.product_id")
            ->leftjoin('brands','products.brand_id','=','brands.id')
            ->leftjoin('types','products.type_id','=','types.id')
            ->leftjoin('stations','products.station_id','=','stations.id')
            ->join('separateSales','detSeparateSales.separateSale_id','=','separateSales.id')
            //->join('salePayments','salePayments.separateSale_id','=','separateSales.id')
            ->join('detCash','separateSales.id','=','detCash.observacion')
            ->join('cashes','detCash.cash_id','=','cashes.id')

            ->join('salePayments','salePayments.separateSale_id','=','separateSales.id')
            ->leftjoin('saledetPayments','saledetPayments.salePayment_id','=','salePayments.id')
            ->leftjoin('saleMethodPayments','saleMethodPayments.id','=','saledetPayments.saleMethodPayment_id')

            ->select(\DB::raw('variants.id as varid,variants.sku,brands.nombre as marca,products.codigo,types.nombre as linea,stations.nombre as estacion,products.modelo,detSeparateSales.subTotal,separateSales.estado as estado,detSeparateSales.cantidad,saleMethodPayments.nombre as SMPNombre,separateSales.tipo as tipo,salePayments.Acuenta as acuenta, salePayments.Saldo as saldo'),
                \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Color" ) as color'),
                \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Taco" ) as Taco'),
                \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Talla" ) as Talla'))

            ->where('cashes.user_id','=', auth()->user()->id)
            ->where('cashes.estado','=','1')
            //->where('detCash.observacion','=','20')
            ->whereIn('detCash.cashMotive_id',array(15,16,17,19,20,21))
            ->groupBy('detSeparateSales.id')
            ->orderBy('detSeparateSales.id','DESC')
            //with(['customer','employee'])
            ->paginate(15);
        return $detSales;
    }
    
} 