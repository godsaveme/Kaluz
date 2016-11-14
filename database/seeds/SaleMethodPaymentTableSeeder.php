<?php

use Illuminate\Database\Seeder;

class SaleMethodPaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'Efectivo',
            'descripcion' => 'Dinero Efectivo.',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'Visa',
            'descripcion' => 'Tarjeta Visa',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'MasterCard',
            'descripcion' => 'Tarjeta MasterCard',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}