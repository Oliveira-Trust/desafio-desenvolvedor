<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert([
            'id' => 1,
            'client_id' => 1,
            'product_id' => 1,
            'status' => 'PAID',
            'quantity_ordered' => 20,
            'created_at' => '2020-02-15 04:28:14',
            'updated_at' => '2020-02-15 04:31:03',
        ]);
    }
}