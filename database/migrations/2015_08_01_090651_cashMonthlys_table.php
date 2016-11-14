<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CashMonthlysTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashMonthlys', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',10,2);
            $table->text('descripcion',150);
            $table->timestamp('fecha');

            $table->integer('expenseMonthlys_id')->unsigned();
            $table->foreign('expenseMonthlys_id')->references('id')->on('expenseMonthlys');

            /*$table->integer('months_id')->unsigned();
            $table->foreign('months_id')->references('id')->on('months');

            $table->integer('years_id')->unsigned();
            $table->foreign('years_id')->references('id')->on('years');*/
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
        Schema::drop('cashMonthlys');
    }
}
