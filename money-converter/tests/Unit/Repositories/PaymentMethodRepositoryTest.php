<?php

namespace Tests\Unit\Repositories;

use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\PaymentMethod\Repositories\PaymentMethodRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function paymentMethodRepository()
    {
        return new PaymentMethodRepository();
    }

    public function mockPaymentMethod()
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

        Fees::create($fees);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_find_payment_method_by_name()
    {
        $this->mockPaymentMethod();

        $paymentMethodName = 'boleto';
        $paymentMethod = $this->paymentMethodRepository()->findByName($paymentMethodName);

        $this->assertNotNull($paymentMethod);
        $this->assertTrue($paymentMethod->name === $paymentMethodName);
    }
}
