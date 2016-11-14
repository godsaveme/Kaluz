<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailPurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto');
            $table->decimal('descuento',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoTotal',10,2);
            $table->integer('detPres_id')->unsigned();
            $table->foreign('detPres_id')->references('id')->on('detPres');
            $table->integer('purchases_id')->unsigned();
            $table->foreign('purchases_id')->references('id')->on('purchases');
            $table->decimal('preProducto',10,2); //quantVar 0 -> sin variantes , 1... con variantes.
            $table->decimal('preCompra',10,2);
            $table->integer('cantidad');
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
        Schema::drop('detailPurchases');
    }
}
