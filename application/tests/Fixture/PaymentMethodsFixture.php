<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentMethodsFixture
 */
class PaymentMethodsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'percent_value' => 1,
                'status' => 1,
                'created' => '2023-09-29 20:43:13',
                'modified' => '2023-09-29 20:43:13',
            ],
        ];
        parent::init();
    }
}
