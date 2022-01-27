<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Unit;

use AwesomeApi\Adapters\AdapterCurrencyCollection;
use Tests\TestCase;

class AdapterCurrencyCollectionTest extends TestCase
{
    public function test_should_return_an_array_with_related_currencies_brl_and_array_adapted(): void
    {
        $adaterCurrencyCollection = new AdapterCurrencyCollection($this->getPayload());
        $combinations = $adaterCurrencyCollection->getCurrencies();

        foreach ($combinations as $combination) {
            $this->assertTrue(array_key_exists($combination['prefix'], $this->combinationOnlyWithBrl()));
            $this->assertArrayHasKey('prefix', $combination);
            $this->assertArrayHasKey('label', $combination);
        }
        $this->assertIsArray($combinations);
    }

    /** @return string[] */
    private function getPayload(): array
    {
        $combinations = [
            'GEL-EUR'  => 'Lari Georgiano/Euro',
            'XAGG-EUR' => 'XPrata/Euro',
            'CHF-BRL'  => 'Franco Suíço/Real Brasileiro',
            'ETH-BRL'  => 'Ethereum/Real Brasileiro'
        ];
        return array_merge($combinations, $this->combinationOnlyWithBrl());
    }

    private function combinationOnlyWithBrl(): array
    {
        return [
            'BRL-AUD'  => 'Real Brasileiro/Dólar Australiano',
            'BRL-AED'  => 'Real Brasileiro/Dirham dos Emirados',
            'BRL-BHD'  => 'Real Brasileiro/Dinar do Bahrein',
            'BRL-SAR'  => 'Real Brasileiro/Riyal Saudita',
        ];
    }

}