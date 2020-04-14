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
            0 => [
                'id' => 1,
                'client_id' => 1,
                'product_id' => 1,
                'status' => 'OPEN',
                'quantity_ordered' => 20,
                'total' => 39.80,
                'created_at' => '2020-02-15 04:28:14',
                'updated_at' => '2020-02-15 04:31:03',
            ]
        ]);
    }
}