<?php

use Illuminate\Database\Seeder;

class PresentationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('presentation')->insert([
            'nombre' => 'Unidades',
            'shortname' => 'Un.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        /*DB::table('presentation')->insert([
            'nombre' => 'Kilogramos',
            'shortname' => 'Kg.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('presentation')->insert([
            'nombre' => 'Litros',
            'shortname' => 'Lt.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);*/
    }
}
