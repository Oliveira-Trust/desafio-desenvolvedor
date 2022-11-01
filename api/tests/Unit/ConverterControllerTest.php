<?php

namespace Tests\Unit;

use App\Http\Controllers\ConverterController;
use App\Services\ConsumeApiService;
use App\Traits\TestHelper;
use PHPUnit\Framework\TestCase;

class ConverterControllerTest extends TestCase
{
    use TestHelper;

    private object $converterController;

    public function setUp(): void
    {
        parent::setUp();
        $this->converterController = new ConverterController(new ConsumeApiService());
    }

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
        $validateInputKeys = $this->getPrivateMethod(ConverterController::class, 'validateInputKeys');
        $result = $validateInputKeys->invokeArgs($this->converterController, array($input));

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
                100001,
                false
            ],
            'string below range' => [
                '999',
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
        $validateValue = $this->getPrivateMethod(ConverterController::class, 'validateValue');
        $result = $validateValue->invokeArgs($this->converterController, array($value));

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
        $validateMethod = $this->getPrivateMethod(ConverterController::class, 'validateMethod');
        $result = $validateMethod->invokeArgs($this->converterController, array($method));

        $this->assertSame($expectedResult, $result);
    }
}
