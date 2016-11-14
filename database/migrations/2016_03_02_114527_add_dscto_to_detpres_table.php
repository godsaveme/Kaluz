<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDsctoToDetpresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detPres', function (Blueprint $table) {
            //
            $table->decimal('dscto', 10, 2);
            $table->decimal('dsctoCant', 10, 2);
            $table->decimal('pvp', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detPres', function (Blueprint $table) {
            //
        });
    }
}
