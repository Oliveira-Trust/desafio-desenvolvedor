<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\StatusType;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Tests\TestCase;

class PaymentMethodServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->paymentMethodService = app(PaymentMethodService::class);
    }

    public function test_get_payment_methods(): void
    {
        $paymentMethod = PaymentMethod::factory(2)->create();
        $result = $this->paymentMethodService->getAllPaymentMethods();

        $this->assertCount(2, $result);
    }

    public function test_not_find_activated_payment_method(): void
    {
        $methodsParams = [
            "method" => "Boleto",
            "fee" => 1,
            "status" => StatusType::INACTIVATED,
        ];
        $this->paymentMethodService->storePaymentMethod($methodsParams);
        $result = $this->paymentMethodService->getAllActivePaymentMethods();

        $this->assertCount(0, $result);
    }

    public function test_find_payment_method_by_id(): void
    {
        $methodsParams = [
            "method" => "Vasco da Gama",
            "fee" => 1,
            "status" => StatusType::ACTIVATED,
        ];
        $paymentMethod = $this->paymentMethodService->storePaymentMethod($methodsParams);
        $result = $this->paymentMethodService->getPaymentMethodById($paymentMethod->id);

        $this->assertEquals('Vasco da Gama', $result->method);
    }

    public function test_store_payment_method(): void
    {
        $methodsParams = [
            "method" => "Pix",
            "fee" => 1.5,
            "status" => StatusType::ACTIVATED,
        ];
        $paymentMethod = $this->paymentMethodService->storePaymentMethod($methodsParams);
        $result = $this->paymentMethodService->getPaymentMethodById($paymentMethod->id);

        $this->assertEquals('Pix', $result->method);
    }

    public function test_update_payment_method(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $methodsParams = [
            "method" => "Vasco da Gama",
            "fee" => 1,
            "status" => StatusType::ACTIVATED,
        ];
        $this->paymentMethodService->updatePaymentMethod($paymentMethod->id, $methodsParams);
        $result = $this->paymentMethodService->getPaymentMethodById($paymentMethod->id);

        $this->assertEquals('Vasco da Gama', $result->method);
    }
}
