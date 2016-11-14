<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fechaEntrega');
            $table->decimal('descuento',10,2);
            $table->decimal('montoBruto',10,2);
            $table->decimal('montoTotal',10,2);
            $table->integer('warehouses_id')->unsigned();
            $table->foreign('warehouses_id')->references('id')->on('warehouses');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->integer('orderPurchase_id')->unsigned()->nullable();
            $table->foreign('orderPurchase_id')->references('id')->on('orderPurchases');
            $table->string('observacion',255);
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
        Schema::drop('purchases');
    }
}
