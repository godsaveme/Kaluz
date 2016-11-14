<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspejoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('espejo', function (Blueprint $table) {
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
/*DB::statement('
          DELIMITER $$
          DROP PROCEDURE IF EXISTS detalles$$
          CREATE PROCEDURE detalles(id int)
          BEGIN
               DECLARE x  INT;
               DECLARE num INT;
               SET num=(select detailPurchases.cantidad from  detailPurchases  
                where detailPurchases.id=id);
               SET x = 1;
               
               loop_label:  LOOP
                           IF  x > num THEN
                               LEAVE  loop_label;
                           END  IF;
                           SET  x = x + 1;
                           INSERT INTO espejo (cantidad, Idvar, modelo, codigo, image,Taco,Talla,sku) 
                          select detailPurchases.cantidad,variants.id as Idvar,products.modelo,variants.codigo,
                          products.image,(select GROUP_CONCAT((CONCAT(atributes.nombre,"/",detAtr.descripcion)) 
                            SEPARATOR "-") from detAtr left join atributes on atributes.id=detAtr.atribute_id 
                          where detAtr.variant_id=1 and atributes.nombre="Taco" )as Taco,(select                                                                                 GROUP_CONCAT((CONCAT(atributes.nombre,"/",detAtr.descripcion)) 
                            SEPARATOR "-") from detAtr left join atributes on atributes.id=detAtr.atribute_id 
                          where detAtr.variant_id=1 and atributes.nombre="Talla" )as Talla,variants.sku from detPres inner join variants on 
                          variants.id=detPres.variant_id inner join detailPurchases on detailPurchases.detPres_id=detPres.id 
                          inner join purchases on purchases.id=detailPurchases.purchases_id inner join products on 
                          products.id=variants.product_id left join detAtr on detAtr.variant_id=variants.id 
                          left join atributes on atributes.id=detAtr.atribute_id where detailPurchases.id=id
                          group by Idvar limit 1; 
 
               END LOOP ;    
       END$$
 DELIMITER ;
 ');
DB::statement('
              DELIMITER $$
              DROP PROCEDURE IF EXISTS principal$$
              CREATE PROCEDURE principal(id int)
              BEGIN
                   DECLARE v_finished INTEGER DEFAULT 0;
                   DECLARE v_content VARCHAR(255) DEFAULT "";
    
                   DECLARE tiket_cursor CURSOR FOR SELECT detailPurchases.id from detPres inner join 
                   variants on variants.id=detPres.variant_id inner join detailPurchases on detailPurchases.detPres_id=detPres.id 
                   inner join purchases on purchases.id=detailPurchases.purchases_id inner join products on 
                   products.id=variants.product_id left join detAtr on detAtr.variant_id=variants.id left join 
                   atributes on atributes.id=detAtr.atribute_id where purchases.id=id group by detailPurchases.id;
                   DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
                   delete from espejo;
                   alter table espejo auto_increment=1;
                   OPEN tiket_cursor;
                   obtener_tiket: LOOP
                           FETCH tiket_cursor INTO v_content;
                           IF v_finished = 1 THEN
                               LEAVE obtener_tiket;
                           END IF;    
                           call detalles(v_content);
                       END LOOP obtener_tiket;
                   CLOSE tiket_cursor;
               SELECT * from espejo;
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
        Schema::drop('espejo');
    }
}
