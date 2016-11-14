<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderSales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaPedido');
            $table->timestamp('fechaEntrega');
            $table->decimal('montoTotal',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('descuento',10,2);
            $table->timestamp('fechaAnulado');
            $table->tinyInteger('estado');
            $table->decimal('igv',10,2);
            $table->string('notas');            

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('employee_id')->unsigned()->nullable();
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
        Schema::drop('orderSales');
    }
}
