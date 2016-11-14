<?php

use Illuminate\Database\Seeder;

class CashMotivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cashMotives')->insert([
            'nombre' => 'Ventas',
            'observacion' => 'Ventas del día',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Préstamos',
            'observacion' => 'Ingreso por Préstamos',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Ingresos Varios',
            'observacion' => 'Ingresos Varios',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Devoluciones',
            'observacion' => 'Ingresos por Devoluciones',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Saldo Anterior',
            'observacion' => 'Ingreso por Saldo Anterior',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Fondo de Caja',
            'observacion' => 'Ingreso por Fondo de Caja',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Compras',
            'observacion' => 'Pagos de Compras',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Créditos',
            'observacion' => 'Pagos de Créditos',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Adelanto Personal',
            'observacion' => 'Adelanto al personal',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago Proveedores',
            'observacion' => 'Pagos de Proveedores',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Gastos Varios',
            'observacion' => 'Gastos Varios',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Viáticos',
            'observacion' => 'Gastos de Viáticos',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago crédito venta',
            'observacion' => 'Pago crédito',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Venta crédito',
            'observacion' => 'Venta crédito',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pedido',
            'observacion' => 'Pedido',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pedido crédito',
            'observacion' => 'Pedido crédito',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago crédito pedido',
            'observacion' => 'Pago crédito pedido',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Reembolso',
            'observacion' => 'Reembolso',
            'tipo' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Separado',
            'observacion' => 'Separado',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Separado crédito',
            'observacion' => 'Separado crédito',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago crédito separado',
            'observacion' => 'Pago crédito separado',
            'tipo' => '+',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
