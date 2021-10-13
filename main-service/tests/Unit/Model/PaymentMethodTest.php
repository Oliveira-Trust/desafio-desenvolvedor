<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use App\Enums\StatusType;
use App\Models\PaymentMethod;
use PHPUnit\Framework\TestCase;

class PaymentMethodTest extends TestCase
{
    private $paymentMethod;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paymentMethod = new PaymentMethod();
    }

    public function test_fillable(): void
    {
        $this->assertEquals(['method', 'fee', 'status'],$this->paymentMethod->getFillable());
    }

    public function test_dates(): void
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->paymentMethod->getDates());
        }
        $this->assertCount(count($dates), $this->paymentMethod->getDates());
    }

    public function testCastsAttribute(): void
    {
        $casts = ['id' => 'int', 'status' => StatusType::class];

        $this->assertEquals($casts, $this->paymentMethod->getCasts());
    }

    public function test_getters_and_setters(): void
    {
        $this->paymentMethod->setMethod('Boleto');
        $this->paymentMethod->setFee(1.0);
        $this->paymentMethod->setStatus(StatusType::ACTIVATED());

        $this->assertEquals('Boleto', $this->paymentMethod->getMethod());
        $this->assertEquals(1.0, $this->paymentMethod->getFee());
        $this->assertEquals(1, $this->paymentMethod->getStatus());
    }
}
