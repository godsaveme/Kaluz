<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('detPayments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->decimal('montoPagado',10,2);
            $table->char('tipoPago',1);
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->integer('methodPayment_id')->unsigned()->nullable();
            $table->foreign('methodPayment_id')->references('id')->on('methodPayments');
            $table->integer('Saldo_F')->unsigned()->nullable();
            $table->foreign('Saldo_F')->references('id')->on('pendientAccounts');
            $table->integer('detCash_id')->unsigned()->nullable();
            $table->foreign('detCash_id')->references('id')->on('detCash');
            $table->integer('cashMonthly_id')->unsigned()->nullable();
            $table->foreign('cashMonthly_id')->references('id')->on('cashMonthlys');
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
        Schema::drop('detPayments');
    }
}
