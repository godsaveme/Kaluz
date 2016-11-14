<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailOrderPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailOrderPurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto');
            $table->decimal('descuento',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoTotal',10,2);
            $table->integer('detPres_id')->unsigned();
            $table->foreign('detPres_id')->references('id')->on('detPres');
            $table->integer('orderPurchases_id')->unsigned();
            $table->foreign('orderPurchases_id')->references('id')->on('orderPurchases');
            $table->decimal('preProducto',10,2); //quantVar 0 -> sin variantes , 1... con variantes.
            $table->decimal('preCompra',10,2);
            $table->integer('cantidad');
            $table->integer('Cantidad_Ll');
            $table->integer('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detailOrderPurchases');
    }
}
