<?php

use Illuminate\Database\Seeder;

class CashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cashes')->insert([
            'fechaInicio' => date("Y-m-d H:i:s"),
            'fechaFin' => '0000-00-00 00:00:00',
            'montoInicial' => 0,
            'ingresos' => 0,
            'gastos' => 0,
            'montoBruto' => 0,
            'montoReal' => 0,
            'descuadre' => 0,
            'estado' => 1,
            'notas' => 'Caja Principal abierta por defecto',
            'cashHeader_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'user_id'=>1
        ]);
    }
}
