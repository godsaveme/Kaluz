<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToNumeroIdToDocumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('headInvoices', function (Blueprint $table) {
            $table->biginteger('numero')->default(0)->after('id');
            $table->string('dni',8)->after('cliente')->nullable();
            $table->string('direccion_cliente',8)->nullable()->after('dni');
            $table->string('tipoDoc',1)->after('cliente_id');
            $table->decimal('vuelto',10,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('headInvoices', function (Blueprint $table) {
            
        });
    }
}
