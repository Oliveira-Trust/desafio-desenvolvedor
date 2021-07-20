<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['id' => 1, 'category_id' => 1, 'name' => 'Monitor LG Ultrawide', 'label' => 'monitor-lg-ultrawide-1', 'value' => 899.00, 'description' => 'Monitor com boa largura', 'enabled' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'category_id' => 1, 'name' => 'Monitor AOC 12345', 'label' => 'monitor-aoc-12345-2', 'value' => 700.09, 'description' => 'Monitor bonito', 'enabled' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            
            ['id' => 3, 'category_id' => 2, 'name' => 'Celular Xiaomi Mi 11', 'label' => 'celular-xiaomi-mi-11-3', 'value' => 3999.18, 'description' => 'Celular moderno', 'enabled' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'category_id' => 2, 'name' => 'Celular Samsung S20', 'label' => 'celular-samsung-s20-4', 'value' => 2999.27, 'description' => 'Celular travado', 'enabled' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            
            ['id' => 5, 'category_id' => 3, 'name' => 'Caixa de Som JBL', 'label' => 'caixa-de-som-jbl-5', 'value' => 520.36, 'description' => 'Caixa de som potente', 'enabled' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'category_id' => 3, 'name' => 'Caixa de Som Kmex', 'label' => 'caixa-de-som-kmex-6', 'value' => 999.45, 'description' => 'Caixa de som com bom bass', 'enabled' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            
            ['id' => 7, 'category_id' => 4, 'name' => 'Notebook Dell 1234', 'label' => 'notebook-dell-1234-7', 'value' => 4999.54, 'description' => 'Notebook excelente', 'enabled' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'category_id' => 4, 'name' => 'Notebook HP', 'label' => 'notebook-hp-8', 'value' => 1999.54, 'description' => 'Notebook problemático', 'enabled' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
