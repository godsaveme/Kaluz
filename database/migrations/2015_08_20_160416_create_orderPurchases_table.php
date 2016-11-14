<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('orderPurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaPedido');
            $table->timestamp('fechaPrevista');
            $table->decimal('descuento',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoTotal',10,2);
            $table->tinyInteger('Estado');
            $table->integer('warehouses_id')->unsigned();
            $table->foreign('warehouses_id')->references('id')->on('warehouses');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::drop('orderPurchases');
    }
}
