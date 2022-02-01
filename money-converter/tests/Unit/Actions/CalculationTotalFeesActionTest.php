<?php

namespace Tests\Unit\Actions;

use Domain\Fees\Actions\CalculationTotalFeesAction;
use PHPUnit\Framework\TestCase;

class CalculationTotalFeesActionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calculation_total_fees()
    {
        $calculationTotalFees = new CalculationTotalFeesAction;
        $calculatedValue = $calculationTotalFees([43.4, 45.5]);

        $this->assertTrue($calculatedValue === 88.9);
    }
}
