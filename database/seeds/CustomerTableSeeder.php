<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->insert([
            'nombres' => 'Cliente',
            'apellidos' => 'Ejemplo',
            'direccContac' => 'Dirección de Cliente Ejemplo',
            'empresa' => 'Empresa Cliente Ejemplo',
            'codigo' => 1,
            'direccFiscal' => 'Dirección Fiscal Ejemplo',
            'ruc' => '10166324507',
            'distrito' => 'Chiclayo',
            'provincia' => 'Chiclayo',
            'departamento' => 'Lambayeque',
            'pais' => 'Peru',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
