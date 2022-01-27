<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Unit;

use AwesomeApi\Adapters\AdapterCurrencyCollection;
use Tests\TestCase;

class CurrencyTest extends TestCase
{

    public function test_should_work(): void
    {
        $adaterCurrencyCollection = new AdapterCurrencyCollection($this->getPayload());
    }

    /** @return string[] */
    private function getPayload(): array
    {
        return [
            'BRL-AUD'  => 'Real Brasileiro/Dólar Australiano',
            'BRL-AED'  => 'Real Brasileiro/Dirham dos Emirados',
            'BRL-BHD'  => 'Real Brasileiro/Dinar do Bahrein',
            'BRL-SAR'  => 'Real Brasileiro/Riyal Saudita',
            'GEL-EUR'  => 'Lari Georgiano/Euro',
            'XAGG-EUR' => 'XPrata/Euro',
            'CHF-BRL'  => 'Franco Suíço/Real Brasileiro',
            'ETH-BRL'  => 'Ethereum/Real Brasileiro'
        ];
    }
}