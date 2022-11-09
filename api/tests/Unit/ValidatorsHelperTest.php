<?php

namespace Tests\Unit;

use App\Traits\TestHelper;
use App\Traits\ValidatorsHelper;
use Tests\TestCase;
use Exception;

class ValidatorsHelperTest extends TestCase
{
    use TestHelper;

    private object $validatorsHelper;

    public function setUp(): void
    {
        parent::setUp();
        $this->validatorsHelper = new class { use ValidatorsHelper; };
    }

    public function provideInputParamsData(): array
    {
        return [
            'correct input' => [
                [
                    'currency_to'   => 'USD',
                    'currency_from' => 'BRL',
                    'value'         => 10000,
                    'method'        => 'credit_card',
                    'send_email'    => false,
                ],
                true
            ],
            'missing data' => [
                [
                    'currency_from' => 'BRL',
                    'value'         => 10000
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
        if (!$expectedResult) {
            $this->expectException(Exception::class);
        }

        $result = $this->validatorsHelper->validateExchangeSimulation($input);

        $this->assertNull($result);
    }
}
