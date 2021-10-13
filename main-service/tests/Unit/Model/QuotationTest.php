<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use App\Enums\StatusType;
use App\Models\Quotation;
use PHPUnit\Framework\TestCase;

class QuotationTest extends TestCase
{
    private $quotation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->quotation = new Quotation();
    }

    public function test_fillable(): void
    {
        $this->assertEquals([
            'user_id',
            'from_currency',
            'to_currency',
            'amount',
            'payment_method',
            'payment_fee',
            'conversion_fee',
            'new_amount',
            'quotation',
            'amount_converted',
        ], $this->quotation->getFillable());
    }

    public function test_dates(): void
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->quotation->getDates());
        }
        $this->assertCount(count($dates), $this->quotation->getDates());
    }

    public function testCastsAttribute(): void
    {
        $casts = [
            'id' => 'int',
            'status' => StatusType::class,
            'created_at' => 'datetime:d/m/Y - H:i',
            'updated_at' => 'datetime:d/m/Y - H:i'
        ];

        $this->assertEquals($casts, $this->quotation->getCasts());
    }
}
