<?php

namespace Tests\Unit;

use App\Models\PaymentType;
use App\Services\PaymentTypeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTypeServiceTest extends TestCase
{
    use RefreshDatabase;

    private function paymentTypeService()
    {
        return new PaymentTypeService();
    }

    public function test_find_by_name()
    {
        $paymentType = ['name' => 'boleto', 'display_name' => 'Boleto'];

        PaymentType::create($paymentType);

        $findPaymentType = $this->paymentTypeService()->findByName($paymentType['name']);

        $this->assertTrue($findPaymentType->name === $paymentType['name']);
        $this->assertTrue($findPaymentType->display_name === $paymentType['display_name']);
    }
}
