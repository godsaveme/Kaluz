<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdcomprasToDetCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detCash', function (Blueprint $table) {
            $table->integer('otherPhead_id')->unsigned()->nullable();
            $table->foreign('otherPhead_id')->references('id')->on('OtherPheads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detCash', function (Blueprint $table) {
            //
        });
    }
}
