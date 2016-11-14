<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serie');
            $table->integer('numero');
            $table->timestamp('fecha');
            $table->string('cliente');
            $table->string('direccion');
            $table->decimal('totalBruto',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('igv',10,2);
            $table->decimal('importe',10,2);
            $table->decimal('porcentajeIgv',10,2);

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales');

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
        Schema::drop('invoices');
    }
}
