<?php

namespace Tests\Unit;

use App\Http\Controllers\ConverterController;
use App\Traits\TestHelper;
use PHPUnit\Framework\TestCase;

class ConverterControllerTest extends TestCase
{
    use TestHelper;

    public function provideInputParamsData(): array
    {
        return [
            'correct input' => [
                [
                    'currency_to',
                    'currency_from',
                    'value',
                    'method'
                ],
                true
            ],
            'missing data' => [
                [
                    'value',
                    'currency'
                ],
                false
            ],
            'different data' => [
                [
                    'value',
                    'currency_to',
                    'currency_from',
                    'metodo'
                ],
                false
            ]
        ];
    }

    /**
     * @dataProvider provideInputParamsData
     */
    public function testShouldAcceptOnlyValidInputParams(array $input, bool $expectedResult): void
    {
        $converter = new ConverterController();

        $validateInputKeys = $this->getPrivateMethod(ConverterController::class, 'validateInputKeys');
        $result = $validateInputKeys->invokeArgs($converter, array($input));

        $this->assertSame($expectedResult, $result);
    }

    public function provideValues(): array
    {
        return [
            'int below range' => [
                100,
                false
            ],
            'int in range' => [
                1400,
                true
            ],
            'int above range' => [
                100000,
                false
            ],
            'string below range' => [
                '1000',
                false
            ],
            'string in range' => [
                '99999',
                true
            ],
            'string above range' => [
                '200000',
                false
            ],
            'float below range' => [
                -110.51,
                false
            ],
            'float in range' => [
                12500.34,
                true
            ],
            'float above range' => [
                120000.50,
                false
            ]
        ];
    }

    /**
     * @dataProvider provideValues
     */
    public function testShouldAcceptOnlyValidValues(String|int|float $value, bool $expectedResult): void
    {
        $converter = new ConverterController();

        $validateValue = $this->getPrivateMethod(ConverterController::class, 'validateValue');
        $result = $validateValue->invokeArgs($converter, array($value));

        $this->assertSame($expectedResult, $result);
    }

    public function provideMethods(): array
    {
        return [
            'credit card' => [
                'credit_card',
                true
            ],
            'payment slip' => [
                'payment_slip',
                true
            ],
            'pix' => [
                'pix',
                false
            ],
            'incorrect' => [
                'incorrect',
                false
            ]
        ];
    }

    /**
     * @dataProvider provideMethods
     */
    public function testShouldAcceptOnlyValidMethods(String $method, bool $expectedResult): void
    {
        $converter = new ConverterController();

        $validateMethod = $this->getPrivateMethod(ConverterController::class, 'validateMethod');
        $result = $validateMethod->invokeArgs($converter, array($method));

        $this->assertSame($expectedResult, $result);
    }
}
