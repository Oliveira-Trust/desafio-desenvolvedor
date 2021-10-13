<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use App\Enums\StatusType;
use App\Models\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    private $currency;

    protected function setUp(): void
    {
        parent::setUp();
        $this->currency = new Currency();
    }

    public function test_fillable(): void
    {
        $this->assertEquals(['name', 'code', 'status'],$this->currency->getFillable());
    }

    public function test_dates(): void
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->currency->getDates());
        }
        $this->assertCount(count($dates), $this->currency->getDates());
    }

    public function testCastsAttribute(): void
    {
        $casts = ['id' => 'int', 'status' => StatusType::class];

        $this->assertEquals($casts, $this->currency->getCasts());
    }

    public function test_getters_and_setters(): void
    {
        $this->currency->setName('Real');
        $this->currency->setCode('BRL');
        $this->currency->setStatus(StatusType::ACTIVATED());

        $this->assertEquals('Real', $this->currency->getName());
        $this->assertEquals('BRL', $this->currency->getCode());
        $this->assertEquals(1, $this->currency->getStatus());
    }
}
