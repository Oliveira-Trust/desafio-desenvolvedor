<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PaymentMethods seed.
 */
class PaymentMethodsSeed extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void {
        $data = [
            [
                'name' => 'Boleto',
                'percent_value' => 1.45,
                'status' => true,
                'created' => date('Y-m-d H:m:i'),
                'modified' => date('Y-m-d H:m:i')
            ],
            [
                'name' => 'Cartão de Crédito',
                'percent_value' => 7.63,
                'status' => true,
                'created' => date('Y-m-d H:m:i'),
                'modified' => date('Y-m-d H:m:i')
            ],
            [
                'name' => 'PIX',
                'percent_value' => 0.63,
                'status' => false,
                'created' => date('Y-m-d H:m:i'),
                'modified' => date('Y-m-d H:m:i')
            ],
        ];

        $table = $this->table('payment_methods');
        $table->insert($data)->save();
    }
}
