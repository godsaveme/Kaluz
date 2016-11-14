<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquivTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equiv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preBase_id')->unsigned();
            $table->integer('preFin_id')->unsigned();
            $table->decimal('cant',10,2);
            $table->foreign('preBase_id')->references('id')->on('presentation');
            $table->foreign('preFin_id')->references('id')->on('presentation');
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
        Schema::drop('equiv');
    }
}
