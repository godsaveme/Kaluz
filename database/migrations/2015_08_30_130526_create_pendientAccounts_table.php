<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendientAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pendientAccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('Saldo',10,2);
            $table->tinyInteger('estado');
            $table->timestamp('fecha');
            $table->integer('orderPurchase_id')->unsigned();
            $table->foreign('orderPurchase_id')->references('id')->on('orderPurchases');
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
        Schema::drop('pendientAccounts');
    }
}
