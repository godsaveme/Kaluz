<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetSalesTable extends Migration
{
    public function up()
    {
        Schema::create('detSales', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precioProducto',10,2);
            $table->decimal('precioVenta',10,2);
            $table->decimal('cantidad',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('subTotal',10,2);

            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->integer('detPre_id')->unsigned();
            $table->foreign('detPre_id')->references('id')->on('detPres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('detSales');
    }
}
