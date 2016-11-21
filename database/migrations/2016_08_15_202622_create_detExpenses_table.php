<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detExpenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detalle');       
            $table->decimal('igv',10,2);
            $table->decimal('total',10,2);
            $table->integer('expense_id')->unsigned();
            $table->foreign('expense_id')->references('id')->on('expenses');
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
        Schema::drop('detExpenses');
    }
}
