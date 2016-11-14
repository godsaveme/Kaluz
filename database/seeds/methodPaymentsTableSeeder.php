<?php

use Illuminate\Database\Seeder;

class methodPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('methodPayments')->insert([
            'nombre' => 'Cheque',
            'descripcion' => 'Pago por cheque',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('methodPayments')->insert([
            'nombre' => 'Contado',
            'descripcion' => 'Pago al contado',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('methodPayments')->insert([
            'nombre' => 'Tarjeta',
            'descripcion' => 'Pago al contado',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('methodPayments')->insert([
            'nombre' => 'Deuda',
            'descripcion' => 'Pago al contado',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
