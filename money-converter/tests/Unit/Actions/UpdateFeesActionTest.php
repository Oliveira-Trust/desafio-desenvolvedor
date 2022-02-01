<?php

namespace Tests\Unit\Actions;

use Domain\Fees\Actions\UpdateFeesAction;
use Domain\Fees\Models\Fees;
use Domain\Fees\Repositories\FeesRepository;
use Domain\PaymentMethod\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateFeesActionTest extends TestCase
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

    public function feesRepository()
    {
        return new FeesRepository();
    }

    public function test_update_fees()
    {
        $fees = $this->mockFees();

        $percentage = 1.54;

        $updateFeesAction = new UpdateFeesAction;
        $updateFeesAction(['percentage' => $percentage], 1);

        $findFees = $this->feesRepository()->findById($fees->id);

        $this->assertTrue(floatval($findFees->percentage) === $percentage);
    }
}
