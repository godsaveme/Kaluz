<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPresentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detPres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variant_id')->unsigned();
            $table->integer('presentation_id')->unsigned();
            $table->decimal('suppPri',10,2)->default(0);
            $table->decimal('markup',10,2)->default(0);
            $table->decimal('price',10,2)->default(0);
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->foreign('presentation_id')->references('id')->on('presentation');
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
        Schema::drop('detPres');
    }
}
