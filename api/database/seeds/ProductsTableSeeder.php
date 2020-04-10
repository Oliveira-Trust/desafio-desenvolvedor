<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();
        
        \DB::table('products')->insert([
            'id' => 1,
            'name' => 'Pão', 
            'price' => 1.00, 
            'available_quantity' => 280, 
            'tags' => '["alimentos", "padaria"]',
            'created_at' => '2020-02-15 04:28:14',
            'updated_at' => '2020-02-15 04:31:03',
        ]);
    }
}