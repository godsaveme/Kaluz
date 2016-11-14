<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NumFactura');
            $table->string('NumSerie');
            $table->char('tipoDoc',1);
            $table->decimal('MontoTotal',10,2);
            $table->decimal('Acuenta',10,2);
            $table->decimal('Saldo',10,2);
            $table->integer('orderPurchase_id')->unsigned()->nullable();
            $table->foreign('orderPurchase_id')->references('id')->on('orderPurchases');
            $table->integer('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::drop('payments');

    }
}
