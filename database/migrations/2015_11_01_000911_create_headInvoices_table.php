<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headInvoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cliente')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ruc',11)->nullable();
            $table->string('GRemicion')->nullable();
            $table->decimal('subTotal',10,2);
            $table->decimal('igv',10,2);
            $table->decimal('Total',10,2);
            $table->integer('venta_id')->unsigned();
            $table->foreign('venta_id')->references('id')->on('sales');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('customers');
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
        Schema::drop('headInvoices');
    }
}
