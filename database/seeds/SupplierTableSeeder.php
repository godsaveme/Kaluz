<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('suppliers')->insert([
            'nombres' => 'Proveedor',
            'apellidos' => 'Ejemplo',
            'direccontacto' => 'Dirección de Contacto Ejemplo',
            'empresa' => 'Empresa Proveedor Ejemplo',
            'codigo' => 1,
            'direccionfiscal' => 'Dirección Fiscal Ejemplo',
            'ruc' => '20561102911',
            'distrito' => 'Chiclayo',
            'provincia' => 'Chiclayo',
            'departamento' => 'Lambayeque',
            'pais' => 'Peru',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
