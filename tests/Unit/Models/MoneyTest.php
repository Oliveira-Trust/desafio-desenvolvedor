<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Exceptions\BuildExceptions;
use App\Models\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    public function test_class_should_throw_exception_when_value_smaller_money_or_equal_1000(): void
    {
        $attributes['money'] = Money::MINIMUM_MONEY;
        $this->expectException(BuildExceptions::class);
        new Money($attributes);
    }

    public function test_class_should_throw_exception_when_value_larger_money_or_equal_100000(): void
    {
        $attributes['money'] = Money::MAXIMUM_MONEY;
        $this->expectException(BuildExceptions::class);
        new Money($attributes);
    }

    public function test_should_return_value_authorized(): void
    {
        $attributes['money'] = 5000;
        $money = (new Money($attributes))->getMoney();
        $this->assertEquals($attributes['money'], $money);
    }
}