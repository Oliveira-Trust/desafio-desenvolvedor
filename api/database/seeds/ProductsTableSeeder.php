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
            0 => [
                'id' => 1,
                'name' => 'Pão', 
                'price' => 1.99,
                'available_quantity' => 280, 
                'tags' => '["Alimentos", "Padaria"]',
                'created_at' => '2020-02-15 04:28:14',
                'updated_at' => '2020-02-15 04:31:03',
            ],
            1 => [
                'id' => 2,
                'name' => 'Escova de dente', 
                'price' => 8.99,
                'available_quantity' => 100, 
                'tags' => '["Higiene", "Saúde", "Pessoal"]',
                'created_at' => '2020-02-15 04:28:14',
                'updated_at' => '2020-02-15 04:31:03',
            ]
        ]);
    }
}