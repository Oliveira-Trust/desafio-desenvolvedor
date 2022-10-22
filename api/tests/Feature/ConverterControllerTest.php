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
            'USD' => [
                'USD',
                true
            ],
            'EUR' => [
                'EUR',
                true
            ],
            'BTC' => [
                'BTC',
                true
            ],
            'BRL' => [
                'BRL',
                false
            ],
            'invalid' => [
                'invalid',
                false
            ]
        ];
    }

    /**
     * @dataProvider provideCurrenciesData
     */
    public function testShouldAcceptOnlyValidCurrencies(String $input, bool $expectedResult): void
    {
        $converter = new ConverterController();

        $validateInput = $this->getPrivateMethod(ConverterController::class, 'validateCurrency');
        $result = $validateInput->invokeArgs($converter, array($input));

        $this->assertSame($expectedResult, $result);
    }
}
