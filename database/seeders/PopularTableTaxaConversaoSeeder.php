<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaxaConversao;

class PopularTableTaxaConversaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $count = TaxaConversao::all()->count();
                if ($count == 0) {
        
                    $this->command->info("Starting ...");
        
                    TaxaConversao::create([
                        'valor_referencia' => 3000.00,
                        'taxa_maior' => 2.0,
                        'taxa_menor' => 1.0,
                        'created_at' => '2023-01-06 16:05:16',
                        'updated_at' => '2023-01-06 16:05:16'
                    ]);
                    $this->command->info("Finished.");
                } else {
                    echo "Qtde: " . $count . " Já povoada!";
                }
            }
        
        
    
}
