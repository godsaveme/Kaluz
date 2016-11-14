<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputStocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto');
            $table->decimal('cantidad_llegado',10,2);
            $table->string('descripcion');
            $table->integer('variant_id')->unsigned();
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->integer('headInputStock_id')->unsigned();
            $table->foreign('headInputStock_id')->references('id')->on('headInputStocks');
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
        Schema::drop('inputStocks');
    }
}
