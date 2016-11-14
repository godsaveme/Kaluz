<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMontoBaseTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orderPurchases', function (Blueprint $table) {
            $table->decimal('montoBase',10,2)->default(0);
            $table->decimal('igv',10,2)->default(0);
            $table->tinyInteger('checkIgv')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orderPurchases', function (Blueprint $table) {
            //
        });
    }
}
