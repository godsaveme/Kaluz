<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleIdToHeadInputStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('headInputStocks', function (Blueprint $table) {
            //
            //$table->integer('sale_id')->unsigned()->references('id')->on('sales');
            $table->integer('sale_id')->unsigned()->nullable();

            $table->foreign('sale_id')->references('id')->on('sales');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('headInputStocks', function (Blueprint $table) {
            //
            $table->dropColumn('sale_id');
        });
    }
}
