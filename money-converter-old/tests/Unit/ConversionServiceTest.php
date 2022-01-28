<?php

namespace Tests\Unit;

use App\Services\ConversionService;
use App\Services\CurrencyService;
use Tests\TestCase;

class ConversionServiceTest extends TestCase
{
    public function conversionService()
    {
        return new ConversionService(new CurrencyService());
    }

    public function test_conversion_by_combination()
    {
        $combination = ['BRL', 'USD'];
        $conversionValue = 4000;

        $conversion = $this->conversionService()->conversionByCombination($combination, $conversionValue);

        $this->assertArrayHasKey('quotation', $conversion);
        $this->assertArrayHasKey('converted', $conversion);
    }
}
