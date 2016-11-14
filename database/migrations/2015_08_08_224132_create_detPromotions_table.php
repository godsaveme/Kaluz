<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detPromotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contador');

            $table->integer('activatorPromotion_id')->unsigned();
            $table->foreign('activatorPromotion_id')->references('id')->on('activatorPromotions');

            $table->integer('detPre_id')->unsigned();
            $table->foreign('detPre_id')->references('id')->on('detPres');
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
        Schema::drop('detPromotions');
    }
}
