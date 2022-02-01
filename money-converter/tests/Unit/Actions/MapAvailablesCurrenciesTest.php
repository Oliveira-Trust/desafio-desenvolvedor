<?php

namespace Tests\Unit\Actions;

use Domain\Currencies\Actions\MapAvailablesCurrencies;
use Domain\Currencies\Repositories\CurrencyRepository;
use Infra\AwesomeApi\AwesomeApiClient;
use Tests\TestCase;

class MapAvailablesCurrenciesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_return_all_availables_currencies()
    {
        $mapedCurrencies = new MapAvailablesCurrencies(
            new CurrencyRepository(
                new AwesomeApiClient()
            )
        );

        $allAvailabels = $mapedCurrencies();

        $this->assertTrue(sizeof($allAvailabels) > 0);
    }
}
