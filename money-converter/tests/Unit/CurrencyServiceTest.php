<?php

namespace Tests\Unit;

use App\Exceptions\HttpException;
use Tests\TestCase;
use App\Services\CurrencyService;

class CurrencyServiceTest extends TestCase
{
    public function currencyService()
    {
        return new CurrencyService();
    }

    public function test_return_all_available_currencies()
    {
        $availableCurrencies = $this->currencyService()->availables();

        $this->assertIsArray($availableCurrencies);
        $this->assertTrue(sizeof($availableCurrencies) > 0);
    }

    public function test_return_last_quotation_from_combination()
    {
        $combination = ['USD', 'BRL'];
        $combinationString = implode('', $combination);

        $lastQuotation = $this->currencyService()->lastQuotation($combination);
        $quotation = $lastQuotation[$combinationString];

        $this->assertIsArray($lastQuotation);
        $this->assertArrayHasKey($combinationString, $lastQuotation);
        $this->assertTrue($quotation['codein'] === $combination[1]);
        $this->assertTrue($quotation['code'] === $combination[0]);
    }
}
