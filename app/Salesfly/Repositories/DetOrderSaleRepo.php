<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetOrderSale;

class DetOrderSaleRepo extends BaseRepo{
    
    public function getModel()
    {
        
        return new DetOrderSale;
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
        $detOrderSales =\DB::table('detOrderSales')->leftjoin("detPres","detPres.id","=","detOrderSales.detPre_id")
                    ->leftjoin("variants","variants.id","=","detPres.variant_id")
                    ->leftjoin("products","products.id","=","variants.product_id")
                    ->leftjoin("presentation","presentation.id","=","detPres.presentation_id")
                    ->leftjoin("equiv","equiv.preFin_id","=","presentation.id")
                    ->leftjoin("stock","stock.variant_id","=","variants.id")
                    
                    ->select(\DB::raw('detOrderSales.*, products.nombre as nameProducto, presentation.nombre as presentacion ,variants.id as vari ,equiv.cant as equivalencia,
                            stock.stockActual as stock, stock.stockPedidos as pedidos,stock.stockSeparados as separados,
                            stock.id as idStock,
                         (SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR " /") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=vari
                                GROUP BY variants.id) as NombreAtributos'))

                    ->where('orderSale_id','=', $id.'%')
                             
                    //with(['customer','employee'])
                    ->paginate(15);
        return $detOrderSales;
    }
    
} 