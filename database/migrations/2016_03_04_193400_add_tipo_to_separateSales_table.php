<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToSeparateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('separateSales', function (Blueprint $table) {
            //
            $table->char('tipo')->default('1'); //1 --> separados, 2 --> pedidos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('separateSales', function (Blueprint $table) {
            //
        });
    }
}
