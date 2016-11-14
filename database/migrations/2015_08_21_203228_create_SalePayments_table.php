<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salePayments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('MontoTotal',10,2);
            $table->decimal('Acuenta',10,2);
            $table->decimal('Saldo',10,2);
            $table->tinyInteger('estado');
            //$table->integer('orderPurchase_id')->unsigned();
            //$table->foreign('orderPurchase_id')->references('id')->on('orderPurchases');
            $table->integer('sale_id')->unsigned()->nullable();;
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->integer('orderSale_id')->unsigned()->nullable();;
            $table->foreign('orderSale_id')->references('id')->on('orderSales');
            $table->integer('separateSale_id')->unsigned()->nullable();;
            $table->foreign('separateSale_id')->references('id')->on('separateSales');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('salePayments');
    }
}
