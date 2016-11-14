<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('codigo')->unique(); //Identificador único para este producto.
            $table->string('suppCode')->unique(); //code para comprar
            $table->string('descripcion')->nullable();
            $table->text('image')->nullable();
            $table->boolean('hasVariants'); //graba si el producto presenta variantes!! false no true si
            $table->integer('type_id')->unsigned()->nullable(); //si deseo agrego tipo
            $table->integer('brand_id')->unsigned()->nullable(); // si.
            $table->integer('material_id')->unsigned()->nullable(); //si..
            $table->integer('station_id')->unsigned()->nullable(); //si..
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->boolean('estado'); //false..deshabilitado, true habilitado , puede ser comprado o vendido
            //$table->string('enventa');
            //$table->string('encompra'); //en variants
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
        Schema::drop('products');
    }
}
