<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaPedido');
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

            $table->integer('orderSale_id')->unsigned()->nullable();;
            $table->foreign('orderSale_id')->references('id')->on('orderSales');

            $table->integer('separateSale_id')->unsigned()->nullable();;
            $table->foreign('separateSale_id')->references('id')->on('separateSales');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('sales');
    }
}
