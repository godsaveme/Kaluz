<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadInputStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headInputStocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('Fecha');
            $table->string('tipo');
            $table->integer('orderPurchase_id')->unsigned()->nullable();
            $table->foreign('orderPurchase_id')->references('id')->on('orderPurchases');
            $table->integer('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->integer('warehouses_id')->unsigned();
            $table->foreign('warehouses_id')->references('id')->on('warehouses');
            $table->integer('warehouDestino_id')->unsigned()->nullable();
            $table->foreign('warehouDestino_id')->references('id')->on('warehouses');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('headInputStocks');
    }
}
