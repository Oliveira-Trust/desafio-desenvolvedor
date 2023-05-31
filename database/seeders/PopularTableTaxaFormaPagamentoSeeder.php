<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaxaFormaPagamento;

class PopularTableTaxaFormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $count = TaxaFormaPagamento::all()->count();
                if ($count == 0) {
        
                    $this->command->info("Starting ...");
        
                    TaxaFormaPagamento::create([
                        'tipo_forma_pagamento' => 1,
                        'descricao' => 'boleto',
                        'taxa' => 1.45,
                        'created_at' => '2023-01-06 16:05:16',
                        'updated_at' => '2023-01-06 16:05:16'
                    ]);
        
                    TaxaFormaPagamento::create([
                        'tipo_forma_pagamento' => 2,
                        'descricao' => 'cartão de pagamento',
                        'taxa' => 7.63,
                        'created_at' => '2023-01-06 16:05:16',
                        'updated_at' => '2023-01-06 16:05:16'
                    ]);
        
        
                    $this->command->info("Finished.");
                } else {
                    echo "Qtde: " . $count . " Já povoada!";
                }
            }       
        
    
}
