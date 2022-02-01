<?php

namespace Tests\Unit\Repositories;

use Domain\Fees\Models\Fees;
use Domain\Fees\Repositories\FeesRepository;
use Domain\PaymentMethod\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeesRepositoryTest extends TestCase
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

        $createFees = Fees::create($fees);

        return ['fees' => $createFees, 'payment_method' => $createPaymentMethod];
    }

    public function feesRepository()
    {
        return new FeesRepository();
    }

    public function test_find_one_fees_by_id()
    {
        $fees = $this->mockFees();

        $findFees = $this->feesRepository()->findById($fees['fees']->id);

        $this->assertNotNull($findFees);
        $this->assertTrue($findFees->id === $fees['fees']->id);
    }

    public function test_find_one_fees_by_payment_method()
    {
        $fees = $this->mockFees();

        $findFees = $this->feesRepository()->findByPaymentMethodId($fees['payment_method']->id);

        $this->assertNotNull($findFees);
        $this->assertTrue($findFees->id === $fees['payment_method']->id);
    }
}
