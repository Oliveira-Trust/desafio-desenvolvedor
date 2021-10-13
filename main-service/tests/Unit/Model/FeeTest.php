<?php

namespace Tests\Unit\Model;

use App\Enums\StatusType;
use App\Models\Fee;
use PHPUnit\Framework\TestCase;

class FeeTest extends TestCase
{
    private $fee;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fee = new Fee();
    }

    public function test_fillable(): void
    {
        $this->assertEquals(
            ['type', 'range', 'less_than', 'more_than', 'description', 'status'],
            $this->fee->getFillable()
        );
    }

    public function test_dates(): void
    {
        $dates = ['created_at', 'updated_at'];
        foreach ($dates as $date) {
            $this->assertContains($date, $this->fee->getDates());
        }
        $this->assertCount(count($dates), $this->fee->getDates());
    }

    public function testCastsAttribute(): void
    {
        $casts = ['id' => 'int', 'status' => StatusType::class];

        $this->assertEquals($casts, $this->fee->getCasts());
    }

    public function test_getters_and_setters(): void
    {
        $this->fee->setType('A');
        $this->fee->setRange(1.0);
        $this->fee->setLessThan(1.0);
        $this->fee->setMoreThan(1.0);
        $this->fee->setDescription('Description');
        $this->fee->setStatus(StatusType::ACTIVATED());

        $this->assertEquals('A', $this->fee->getType());
        $this->assertEquals(1.0, $this->fee->getRange());
        $this->assertEquals(1, $this->fee->getLessThan());
        $this->assertEquals(1, $this->fee->getMoreThan());
        $this->assertEquals('Description', $this->fee->getDescription());
        $this->assertEquals(1, $this->fee->getLessThan());
    }

    public function test_createFromEloquent(): void
    {
        $values = [
            [
                'type' => 'A',
                'range' => 3000,
                'less_than' => 1.5,
                'more_than' => 1.0,
                'description' => 'Description',
                'status' => StatusType::INACTIVATED
            ]
        ];
        $fee = $this->fee::createFromEloquent($values);

        $this->assertEquals('A', $fee->getType());
        $this->assertEquals(3000, $fee->getRange());
        $this->assertEquals(1.5, $fee->getLessThan());
        $this->assertEquals(1, $fee->getMoreThan());
        $this->assertEquals('Description', $fee->getDescription());
        $this->assertEquals(0, $fee->getStatus());
    }
}
