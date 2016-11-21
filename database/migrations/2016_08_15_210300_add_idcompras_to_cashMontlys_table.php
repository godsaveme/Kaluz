<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdcomprasToCashMontlysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashMonthlys', function (Blueprint $table) {
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
        Schema::table('cashMonthlys', function (Blueprint $table) {
            //
        });
    }
}
