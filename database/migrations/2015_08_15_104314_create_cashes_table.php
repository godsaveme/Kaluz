<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaInicio');
            $table->timestamp('fechaFin');
            $table->decimal('montoInicial',10,2);
            $table->decimal('ingresos',10,2);
            $table->decimal('gastos',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoReal',10,2);
            $table->decimal('descuadre',10,2);
            $table->tinyInteger('estado');
            $table->string('notas');

            $table->integer('cashHeader_id')->unsigned();
            $table->foreign('cashHeader_id')->references('id')->on('cashHeaders');
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
        Schema::drop('cashes');
    }
}
