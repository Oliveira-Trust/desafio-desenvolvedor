<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\ConverterController;
use App\Traits\TestHelper;
use Tests\TestCase;

class ConverterControllerTest extends TestCase
{
    use TestHelper;

    public function provideCurrenciesData(): array
    {
        return [
            'USD-BRL' => [
                ['USD', 'BRL'],
                true
            ],
            'EUR-BRL' => [
                ['EUR', 'BRL'],
                true
            ],
            'BTC-EUR' => [
                ['BTC', 'EUR'],
                true
            ],
            'BRL-BRL' => [
                ['BRL', 'BRL'],
                false
            ],
            'BRL-invalid' => [
                ['BRL','invalid'],
                false
            ],
            'invalid-USD' => [
                ['invalid', 'USD'],
                false
            ],
            'invalid-invalid' => [
                ['invalid', 'invalid'],
                false
            ]
        ];
    }

    /**
     * @dataProvider provideCurrenciesData
     */
    public function testShouldAcceptOnlyValidCurrencies(array $currencies, bool $expectedResult): void
    {
        $converter = new ConverterController();

        $validateCurrency = $this->getPrivateMethod(ConverterController::class, 'validateCurrencies');
        $result = $validateCurrency->invokeArgs($converter, array($currencies[0], $currencies[1]));

        $this->assertSame($expectedResult, $result);
    }
}
