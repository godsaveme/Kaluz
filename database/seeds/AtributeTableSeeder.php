<?php

use Illuminate\Database\Seeder;

class AtributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atributes')->insert([
            'nombre' => 'Color',
            'shortname' => 'CL',
            'descripcion' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Talla',
            'shortname' => 'TL',
            'descripcion' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Taco',
            'shortname' => 'TC',
            'descripcion' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Material',
            'shortname' => 'MT',
            'descripcion' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
