<?php

use Illuminate\Database\Seeder;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('warehouses')->insert([
            'nombre' => 'Almacén Central',
            'shortname' => 'AC',
            'descripcion' => 'Almacén Central del la Tienda creado por defecto',
            'capacidad' => '100',
            'store_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
