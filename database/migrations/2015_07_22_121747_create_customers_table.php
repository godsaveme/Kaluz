<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('empresa');
            $table->string('direccFiscal');
            $table->string('ruc');
            $table->string('dni'); //no unique porque no se puede poner vacio en dos filas y no es necesario para ser agregado.
            $table->integer('codigo')->unique();
            $table->dateTime('fechaNac');
            $table->char('genero',1);
            $table->string('fijo');
            $table->string('movil');
            $table->string('email');
            $table->text('website');
            $table->string('direccContac');
            $table->string('distrito');
            $table->string('provincia');
            $table->string('departamento');
            $table->string('pais');
            $table->text('notas');
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
        Schema::drop('customers');
    }
}
