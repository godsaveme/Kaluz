<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspejo2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espejo2', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cantidad',10,2);
            $table->integer('Idvar');
            $table->string('modelo');
            $table->string('codigo');
            $table->text('image');
            $table->String('Taco');
            $table->String('Talla');
            $table->bigInteger('sku');
        });
       /* DB::STATEMENT('
          DELIMITER $$
          DROP PROCEDURE IF EXISTS detalles2$$
          CREATE PROCEDURE detalles2(id int)
          BEGIN
               DECLARE x  INT;
               DECLARE num INT;
               SET num=(select detailOrderPurchases.Cantidad_Ll from  detailOrderPurchases 
                where detailOrderPurchases.id=id);
               SET x = 1;
               
               loop_label:  LOOP
                           IF  x > num THEN
                               LEAVE  loop_label;
                           END  IF;
                           SET  x = x + 1;
                           INSERT INTO espejo2 (cantidad, Idvar, modelo, codigo, image,Taco,Talla,sku) 
                           select detailOrderPurchases.cantidad,variants.id as Idvar,products.modelo,
                           variants.codigo,products.image,(select GROUP_CONCAT((CONCAT(atributes.nombre,"/",detAtr.descripcion))
                           SEPARATOR "-") from detAtr left join atributes on atributes.id=detAtr.atribute_id 
                           where detAtr.variant_id=Idvar and atributes.nombre="Taco" )as Taco,(select GROUP_CONCAT((CONCAT(atributes.nombre,"/",detAtr.descripcion))
                           SEPARATOR "-") from detAtr left join atributes on atributes.id=detAtr.atribute_id 
                           where detAtr.variant_id=Idvar and atributes.nombre="Talla" )as 
                           Talla,variants.sku from detPres inner join variants on variants.id=detPres.variant_id inner 
                           join detailOrderPurchases on detailOrderPurchases.detPres_id=detPres.id inner join orderPurchases 
                           on orderPurchases.id=detailOrderPurchases.orderPurchases_id inner join products on 
                           products.id=variants.product_id left join detAtr on detAtr.variant_id=variants.id 
                           left join atributes on atributes.id=detAtr.atribute_id where detailOrderPurchases.id=id 
                           group by Idvar limit 1;
 
               END LOOP;    
       END$$
 DELIMITER ;
 ');
DB::STATEMENT('
              DELIMITER $$
              DROP PROCEDURE IF EXISTS principal2$$
              CREATE PROCEDURE principal2(id int)
              BEGIN
                   DECLARE v_finished INTEGER DEFAULT 0;
                   DECLARE v_content VARCHAR(255) DEFAULT "";
    
                  DECLARE tiket_cursor CURSOR FOR SELECT detailOrderPurchases.id from detPres inner join 
                  variants on variants.id=detPres.variant_id inner join detailOrderPurchases on 
                  detailOrderPurchases.detPres_id=detPres.id inner join orderPurchases on 
                  orderPurchases.id=detailOrderPurchases.orderPurchases_id inner join products on 
                  products.id=variants.product_id left join detAtr on detAtr.variant_id=variants.id 
                  left join atributes on atributes.id=detAtr.atribute_id where orderPurchases.id=id 
                  group by detailOrderPurchases.id;
                   delete from espejo2;
                   alter table espejo2 auto_increment=1;
                   OPEN tiket_cursor;
                   obtener_tiket: LOOP
                           FETCH tiket_cursor INTO v_content;
                           IF v_finished = 1 THEN
                               LEAVE obtener_tiket;
                           END IF;    
                           call detalles2(v_content);
                       END LOOP obtener_tiket;
                   CLOSE tiket_cursor;
               SELECT * from espejo2;
               END$$
               DELIMITER ;'
               );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('espejo2');
    }
}
