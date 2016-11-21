<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOthersPdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OtherPdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cantidad',10,2);
            $table->string('descripcion');           
            $table->decimal('PrecioUnit',10,2);
            $table->decimal('PrecioFinal',10,2);
            $table->integer('otherPhead_id')->unsigned();
            $table->foreign('otherPhead_id')->references('id')->on('OtherPheads');
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
         Schema::drop('OtherPdetails');
    }
}
