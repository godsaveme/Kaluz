<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detCash', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('montoCaja',10,2);
            $table->decimal('montoMovimientoTarjeta',10,2);
            $table->decimal('montoMovimientoEfectivo',10,2);
            $table->decimal('montoFinal',10,2);
            $table->tinyInteger('estado');
            $table->string('observacion');

            $table->integer('cashMotive_id')->unsigned();
            $table->foreign('cashMotive_id')->references('id')->on('cashMotives');
            $table->integer('cash_id')->unsigned();
            $table->foreign('cash_id')->references('id')->on('cashes');
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
        Schema::drop('detCash');
    }
}
