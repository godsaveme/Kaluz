<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->string('proveedor');
            $table->string('ruc');
            $table->string('direccion');
            $table->string('numeroDocumento');
            $table->string('serie');
            $table->decimal('MontoTotal',10,2)->default(0);
            $table->string('tipoDoc',1);
            $table->decimal('montoPagado',10,2)->default(0);
            $table->decimal('Saldo',10,2)->default(0);
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
        Schema::drop('expenses');
    }
}
