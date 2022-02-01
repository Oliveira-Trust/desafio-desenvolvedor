<?php

namespace Tests\Unit\Actions;

use Domain\Fees\Actions\CalculationConversionFeesAction;
use PHPUnit\Framework\TestCase;

class CalculationConversionFeesActionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_conversion_fees_action()
    {
        $value = 2500;

        $calcConversionFeesAction = new CalculationConversionFeesAction;
        $feesValue = $calcConversionFeesAction($value);

        $this->assertTrue($feesValue === 50.0);
    }
}
