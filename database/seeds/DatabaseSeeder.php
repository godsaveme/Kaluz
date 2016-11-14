<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(StoreTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(monthTableSeeder::class);
        $this->call(ExtraProductTableSeeder::class);
        $this->call(PresentationTableSeeder::class);
        $this->call(methodPaymentsTableSeeder::class);
        $this->call(AtributeTableSeeder::class);
        $this->call(SaleMethodPaymentTableSeeder::class);
        $this->call(CashMotivesTableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(CashHeaderTableSeeder::class);
        //$this->call(CashTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(expenseMonthlysTableSeeder::class);
        $this->call(FBnumberTableSeeder::class);
        Model::reguard();
    }
}
