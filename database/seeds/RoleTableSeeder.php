<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array('name' => 'Administrador',
            'shortname' => 'admin',
            'descripcion' => 'Administrador General del Sistema',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Cajero',
                'shortname' => 'ca',
                'descripcion' => 'Cajero del Sistema',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"))
    ));
    }
}
