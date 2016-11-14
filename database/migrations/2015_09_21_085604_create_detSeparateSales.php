<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetSeparateSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detSeparateSales', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precioProducto',10,2);
            $table->decimal('precioVenta',10,2);
            $table->decimal('cantidad',10,2);
            $table->decimal('canPendiente',10,2);
            $table->decimal('canEntregado',10,2);
            $table->decimal('parteEntregado',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('subTotal',10,2);
            $table->tinyInteger('estado');

            $table->integer('separateSale_id')->unsigned();
            $table->foreign('separateSale_id')->references('id')->on('separateSales');

            $table->integer('detPre_id')->unsigned()->nullable();;
            $table->foreign('detPre_id')->references('id')->on('detPres');
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
        Schema::drop('separateSales');
    }
}
