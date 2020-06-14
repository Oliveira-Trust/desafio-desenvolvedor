<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            'status' => "Em Aberto",
        ]);

        DB::table('order_status')->insert([
            'status' => "Pago",
        ]);
        
        DB::table('order_status')->insert([
            'status' => "Cancelado",
        ]);
    }
}
