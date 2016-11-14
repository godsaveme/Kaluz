<?php

use Illuminate\Database\Seeder;

class ExtraProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([
            'nombre' => 'Marca Genérica',
            'shortname' => 'GE',
            'descripcion' => 'Marca genérica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('types')->insert([
            'nombre' => 'Línea Genérica',
            'shortname' => 'GE',
            'descripcion' => 'Línea genérica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('materials')->insert([
            'nombre' => 'Material Genérico',
            'shortname' => 'GE',
            'descripcion' => 'Material genérico creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('stations')->insert([
            'nombre' => 'Estación Genérica',
            'shortname' => 'GE',
            'descripcion' => 'Estación genérica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
