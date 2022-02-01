<?php

namespace Tests\Unit\Actions;

use Domain\Fees\Actions\CalculationPaymentFeesAction;
use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalculationPaymentFeesActionTest extends TestCase
{
    use RefreshDatabase;

    public function mockFees()
    {
        $paymentMethod = [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];

        $createPaymentMethod = PaymentMethod::create($paymentMethod);

        $fees = [
            'payment_method_id' => $createPaymentMethod->id,
            'percentage' => 1.74,
        ];

        return Fees::create($fees);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calculation_payment_method_fees()
    {
        $calculationPaymentFeesAction = new CalculationPaymentFeesAction;
        $calculatedValue = $calculationPaymentFeesAction($this->mockFees(), 3500);

        $this->assertTrue($calculatedValue === 60.9);
    }
}
