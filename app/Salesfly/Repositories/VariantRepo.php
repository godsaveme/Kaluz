<?php

namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\Variant;

class VariantRepo extends BaseRepo{

    public function getModel(){
        return new Variant;
    }

    public function find($id){
        return Variant::find($id)->load(['detPre' => function ($query){
            $query->join('presentation','presentation.id','=','detPres.presentation_id');
            //$query->orderBy('id');
        },'stock','product']);
    }

    public function getAttr($id){
        return Variant::find($id)->load(['detAtr']);
    }
    public function searchCodigo($q)
    {
        $products =Variant::select('id','codigo')
                    //with(['customer','employee'])
                    ->groupBy('variants.codigo')
                    ->get();
        return $products;
    }

    //public function findV($id){
    //    return Variant::find($id);
    //}

  /*public function paginaterepo($c){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $variants = Variant::with(array('product'=>function($query){
            $query->select('id','nombre');
        }))->paginate($c);
        return $variants;
    } */
    

     public function paginaterepo($c){
        //$warehouses = Warehouse::with('store')->paginate($c);
        $variants=Variant::join('detAtr','detAtr.variant_id','=','variants.id')
        //->join('atributes','detAtri.atribute_id','=','atribute.id')
       // ->join('brands','products.brand_id','=','brands.id')->groupBy('products.id')
       // ->join('stations','products.station_id','=','stations.id')
        ->select('variants.precio ','detAtr.decripcion ')->get();
        return $variants;
        
    }
    public function findVariant($id){
       $variants=Variant::join('detAtr','variants.id','=','detAtr.variant_id')
                        ->join('products','products.id','=','variants.product_id')
                        ->leftjoin('brands','products.brand_id','=','brands.id')
                        ->join('detPres','detPres.variant_id','=','variants.id')
                        ->leftjoin('types','products.type_id','=','types.id')
                        ->leftjoin('materials','materials.id','=','products.material_id')
                        ->join('presentation','detPres.presentation_id','=','presentation.id')
                        ->leftjoin('equiv','equiv.preFin_id','=','presentation.id')
                       ->where('detPres.id','=',$id)
        ->select(\DB::raw('variants.*,detAtr.descripcion as Atrdescri,presentation.nombre as PRename,
            equiv.cant as equivalencia,equiv.preBase_id as base,products.nombre as Pnombre,brands.nombre as Bnombre
                            ,types.nombre as Tnombre,materials.nombre as Mnombre'))->groupBy('variants.id')->first();
       
        return $variants;
    }
    public function selectByID($id,$var){
        $variant=Variant::leftjoin('detAtr','detAtr.variant_id','=','variants.id')
                          ->leftjoin('atributes','atributes.id','=','detAtr.atribute_id')
                          ->join('products','products.id','=','variants.product_id')
                          //->join('detPres','detPres.variant_id','=','variants.id')
                          //->join('presentation','detPres.presentation_id','=','presentation.id')
                          ->where('variants.codigo','=',$id)->where('atributes.nombre','=',$var)
                          ->select(\DB::raw('variants.sku as varSku,variants.id as varCodigo,products.hasVariants as TieneVariante,
                            atributes.shortname as nomCortoVar,detAtr.descripcion as valorDetAtr,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR "/") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo
                                GROUP BY variants.id) as NombreAtributos'))->groupBy('detAtr.descripcion')->paginate();
        return $variant;
    }
    public function selectTalla($id,$taco){
         $variant=Variant::leftjoin('detAtr','detAtr.variant_id','=','variants.id')
                          ->leftjoin('atributes','atributes.id','=','detAtr.atribute_id')
                          ->join('products','products.id','=','variants.product_id')
                          //->join('detPres','detPres.variant_id','=','variants.id')
                          //->join('presentation','detPres.presentation_id','=','presentation.id')
                          ->where('variants.codigo','=',$id)->where('detAtr.descripcion','=',$taco)
                          ->select(\DB::raw("variants.sku as varSku,variants.id as varCodigo,products.hasVariants as TieneVariante,variants.codigo as variantCondigo,
                            atributes.shortname as nomCortoVar,(SELECT (detAtr.descripcion ) FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo and atributes.nombre='Talla'
                                GROUP BY variants.codigo)as valorDetAtr,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,':',detAtr.descripcion) SEPARATOR '/') FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo
                                GROUP BY variants.id) as NombreAtributos"))
                          ->groupBy('variants.id')->paginate();
        return $variant;
    }
     public function selectStocksTalla($id,$taco,$almac){
         $variant=Variant::leftjoin('detAtr','detAtr.variant_id','=','variants.id')
                          ->leftjoin('atributes','atributes.id','=','detAtr.atribute_id')
                          ->join('products','products.id','=','variants.product_id')
                          ->leftjoin('stock','stock.variant_id','=','variants.id')
                          //->join('detPres','detPres.variant_id','=','variants.id')
                          //->join('presentation','detPres.presentation_id','=','presentation.id')
                          ->where('variants.codigo','=',$id)->where('detAtr.descripcion','=',$taco)
                          ->select(\DB::raw("stock.stockActual as stock,variants.sku as varSku,variants.id as varCodigo,products.hasVariants as TieneVariante,variants.codigo as variantCondigo,
                            atributes.shortname as nomCortoVar,(SELECT (detAtr.descripcion ) FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo and atributes.nombre='Talla'
                                GROUP BY variants.id)as valorDetAtr,(SELECT (stock.stockActual ) FROM variants
                                INNER JOIN stock ON stock.variant_id = variants.id
                                INNER JOIN warehouses ON warehouses.id = stock.warehouse_id
                                where variants.id=varCodigo and warehouses.id=$almac
                                GROUP BY stock.id)as stockActual,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,':',detAtr.descripcion) SEPARATOR '/') FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo
                                GROUP BY variants.id) as NombreAtributos"))
                          ->groupBy('variants.id')->paginate();
        return $variant;
    }
      public function selectStocksTallaSinTaco($id,$almac){
         $variant=Variant::leftjoin('detAtr','detAtr.variant_id','=','variants.id')
                          ->leftjoin('atributes','atributes.id','=','detAtr.atribute_id')
                          ->join('products','products.id','=','variants.product_id')
                          ->leftjoin('stock','stock.variant_id','=','variants.id')
                          //->join('detPres','detPres.variant_id','=','variants.id')
                          //->join('presentation','detPres.presentation_id','=','presentation.id')
                          ->where('variants.codigo','=',$id)->where('atributes.nombre','=','Talla')
                          ->select(\DB::raw("stock.stockActual as stock,variants.sku as varSku,variants.id as varCodigo,products.hasVariants as TieneVariante,variants.codigo as variantCondigo,
                            atributes.shortname as nomCortoVar,(SELECT (detAtr.descripcion ) FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo and atributes.nombre='Talla'
                                GROUP BY variants.id)as valorDetAtr,(SELECT (stock.stockActual ) FROM variants
                                INNER JOIN stock ON stock.variant_id = variants.id
                                INNER JOIN warehouses ON warehouses.id = stock.warehouse_id
                                where variants.id=varCodigo and warehouses.id=$almac
                                GROUP BY stock.id)as stockActual,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,':',detAtr.descripcion) SEPARATOR '/') FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varCodigo
                                GROUP BY variants.id) as NombreAtributos"))
                          ->groupBy('variants.id')->paginate();
        return $variant;
    }
    public function traer_por_Sku($sku){
       
        $variants=Variant::leftjoin('detAtr','variants.id','=','detAtr.variant_id')
                        ->join('products','products.id','=','variants.product_id')
                        ->leftjoin('brands','products.brand_id','=','brands.id')
                        ->leftjoin('stock','stock.variant_id','=','variants.id')
                        //->join('presentation','detPres.presentation_id','=','presentation.id')
                        ->leftjoin('types','products.type_id','=','types.id')
                        ->leftjoin('materials','materials.id','=','products.material_id')
                        ->where('variants.sku','=',$sku)
                            //->leftjoin('variants','products.id','=','variants.product_id')
                            //->leftjoin("atributes","atributes.id","=","detAtr.atribute_id")
                            ->select(\DB::raw('products.id as proId,stock.stockActual,brands.nombre as BraName,types.nombre as TName,products.codigo as proCodigo,products.nombre as proNombre,
                              variants.id as varid,variants.sku as varcode,variants.suppPri as varPrice,variants.price as precioProducto,
                               products.hasVariants as TieneVariante,products.created_at as proCreado,brands.id as BraID,materials.id as MId
                              ,materials.nombre as Mnombre,variants.codigo as varCodigo,detAtr.descripcion as descripcion,products.quantVar as proQuantvar,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR "/") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varid
                                GROUP BY variants.id) as NombreAtributos'))->groupBy('variants.id')
                            ->first();
        /*->select(\DB::raw('variants.*,variants.id as varid,products.nombre as nombre,detAtr.descripcion as descripcion,
            (SELECT GROUP_CONCAT(detAtr.descripcion SEPARATOR "-") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varid
                                GROUP BY variants.id) as NombreAtributos'))->groupBy('variants.id')->paginate(15);*/
        return $variants;
    } 
    public function Paginar_por_Variante(){
       
       $variants=Variant::leftjoin('detAtr','variants.id','=','detAtr.variant_id')
                        ->join('products','products.id','=','variants.product_id')
                        ->leftjoin('brands','products.brand_id','=','brands.id')
                        //->join('detPres','detPres.variant_id','=','variants.id')
                        //->join('presentation','detPres.presentation_id','=','presentation.id')
                        ->leftjoin('types','products.type_id','=','types.id')
                        ->leftjoin('materials','materials.id','=','products.material_id')
                        //->where('variants.sku','=',$sku)
                            //->leftjoin('variants','products.id','=','variants.product_id')
                            //->leftjoin("atributes","atributes.id","=","detAtr.atribute_id")
                            ->select(\DB::raw('products.id as proId,brands.nombre as BraName,types.nombre as TName,products.codigo as proCodigo,products.nombre as proNombre,
                              variants.id as varid,variants.sku as varcode,variants.suppPri as varPrice,variants.price as precioProducto,
                               products.hasVariants as TieneVariante,products.created_at as proCreado,brands.id as BraID,materials.id as MId
                              ,materials.nombre as Mnombre,variants.codigo as varCodigo,detAtr.descripcion as descripcion,products.quantVar as proQuantvar,(SELECT GROUP_CONCAT(CONCAT(atributes.shortname,":",detAtr.descripcion) SEPARATOR "/") FROM variants
                                INNER JOIN detAtr ON detAtr.variant_id = variants.id
                                INNER JOIN atributes ON atributes.id = detAtr.atribute_id
                                where variants.id=varid
                                GROUP BY variants.id) as NombreAtributos'))->groupBy('variants.id')
                            ->get();
     return $variants;
    } 

  

}