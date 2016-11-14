<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeecostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('employeecosts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('SueldoFijo',10,2);
            $table->decimal('comisiones',10,2);
            $table->decimal('seguro',10,2);
            $table->decimal('menu',10,2);
            $table->decimal('pasajes',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('total',10,2);
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::drop('employeecosts');
    }
}
