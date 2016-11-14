<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetSale;

class DetSaleRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetSale;
    }

    public function search($q)
    {
        $detSales =DetSale::where('nombre','like', $q.'%')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detSales;
    }
    public function searchDetalle($id)
    {
        //$detOrders = \DB::table('detOrders')->leftjoin('detPres','detOrders.detPre_id','=','detPres.id')
        $detSales =\DB::table('detSales')->leftjoin("detPres","detPres.id","=","detSales.detPre_id")
                    ->leftjoin("variants","variants.id","=","detPres.variant_id")
                    ->leftjoin("products","products.id","=","variants.product_id")
                    ->leftjoin("presentation","presentation.id","=","detPres.presentation_id")
                    ->leftjoin("equiv","equiv.preFin_id","=","presentation.id")
                    ->leftjoin("stock","variants.id","=","stock.variant_id")
                    ->leftjoin("warehouses","warehouses.id","=","stock.warehouse_id")
                    
                    ->select(\DB::raw('detSales.*, products.nombre as nameProducto, presentation.nombre as presentacion ,variants.sku,variants.codigo,variants.id as vari , warehouses.id as idAlmacen,
                        stock.id as idStock,
                        (SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR " /") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id) as NombreAtributos'))

                    ->where('sale_id','=', $id.'%')
                             
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detSales;
    }
    public function listarVentasDia(){
        $detSales =\DB::table('detSales')
                    ->leftjoin("detPres","detPres.id","=","detSales.detPre_id")
                    ->leftjoin("variants","variants.id","=","detPres.variant_id")
                    ->leftjoin("products","products.id","=","variants.product_id")
                    ->leftjoin('brands','products.brand_id','=','brands.id')
                    ->leftjoin('types','products.type_id','=','types.id')
                    ->leftjoin('stations','products.station_id','=','stations.id')
                    ->join('sales','detSales.sale_id','=','sales.id')
                    ->join('detCash','sales.detCash_id','=','detCash.id')
                    ->join('cashes','detCash.cash_id','=','cashes.id')

                    ->join('salePayments','salePayments.sale_id','=','sales.id')
                    ->join('saledetPayments','saledetPayments.salePayment_id','=','salePayments.id')
                    ->join('saleMethodPayments','saleMethodPayments.id','=','saledetPayments.saleMethodPayment_id')

                    ->select(\DB::raw('variants.id as varid,detPres.suppPri as precioCompra,(detSales.subTotal-detPres.suppPri)as ganacia,variants.sku,brands.nombre as marca,products.codigo,types.nombre as linea,stations.nombre as estacion,products.modelo,detSales.subTotal,sales.estado as estado,detSales.cantidad,saleMethodPayments.nombre as SMPNombre'),
                         \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Color" ) as color'),
                         \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Taco" ) as Taco'),
                         \DB::raw('(select dt.descripcion from detAtr dt inner join variants v on v.id=dt.variant_id inner join atributes atr on atr.id=dt.atribute_id where v.id=varid and atr.nombre="Talla" ) as Talla'))

                    ->where('cashes.user_id','=', auth()->user()->id)
                    ->where('cashes.estado','=','1')    
                    ->groupBy('detSales.id')
                    ->orderBy('detSales.id','DESC')
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detSales;
    }
} 