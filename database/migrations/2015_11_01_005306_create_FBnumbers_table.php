<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFBnumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('FBnumbers', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('numFactura');
            $table->biginteger('numBoleta');
            $table->integer('caja_id')->unsigned();
            $table->foreign('caja_id')->references('id')->on('cashHeaders');
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
        Schema::drop('FBnumbers');
    }
}
