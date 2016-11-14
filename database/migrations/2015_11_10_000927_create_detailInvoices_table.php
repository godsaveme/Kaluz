<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailInvoices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cantidad',10,2);
            $table->string('descripcion');
            $table->decimal('PrecioUnit',10,2);
            $table->decimal('PrecioVent',10,2);
            $table->integer('headInvoice_id')->unsigned();
            $table->foreign('headInvoice_id')->references('id')->on('headInvoices');
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
        Schema::drop('detailInvoices');
    }
}
