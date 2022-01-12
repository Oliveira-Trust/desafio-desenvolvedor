<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Fee\Models\Fee;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::create([
            'type'           => 'defaultServiceFee',
            'payment_method' => null,
            'depends_on'     => null,
            'fee'            => 2,
            'label'          => 'Taxa padrão de serviço'
        ]);

        Fee::create([
            'type'           => 'discount',
            'payment_method' => null,
            'depends_on'     => 3000,
            'fee'            => 1,
            'label'          => 'Taxa com desconto'
        ]);

        Fee::create([
            'type'           => 'paymentMethod',
            'payment_method' => 'creditCard',
            'depends_on'     => null,
            'fee'            => 7.63,
            'label'          => 'Taxa por método de pagamento'
        ]);

        Fee::create([
            'type'           => 'paymentMethod',
            'payment_method' => 'boleto',
            'depends_on'     => null,
            'fee'            => 1.45,
            'label'          => 'Taxa por método de pagamento'
        ]);
    }

}
