<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CurrencyConversionsFixture
 */
class CurrencyConversionsFixture extends TestFixture
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
                'user_id' => 1,
                'origin_currency' => 'Lorem ipsum dolor sit amet',
                'destination_currency' => 'Lorem ipsum dolor sit amet',
                'value_to_convert' => 1,
                'payment_method' => 'Lorem ipsum dolor sit amet',
                'destination_currency_conversion_value' => 1,
                'destination_currency_purchased_value' => 1,
                'payment_tax' => 1,
                'conversion_tax' => 1,
                'conversion_value_without_tax' => 1,
                'created' => '2023-10-02 07:59:40',
            ],
        ];
        parent::init();
    }
}
