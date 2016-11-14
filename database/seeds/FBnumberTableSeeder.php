<?php

use Illuminate\Database\Seeder;

class FBnumberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('FBnumbers')->insert(array(
            array('numFactura' =>0,
            'numBoleta' => 0,
            'caja_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"))
            
         ));
    }
}
