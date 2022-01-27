<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\ConversionRate;
use App\Models\Money;
use Tests\TestCase;

class ConversionRateTest extends TestCase
{
    public function test_should_to_check_fee_conversion_rate_when_money_larger_3000(): void
    {
        foreach ($this->getMoneyLargerThreeThousandObjects() as $money) {
            $conversionRate = (new ConversionRate($money))->getFees();
            $this->assertEquals(
                $conversionRate, $money->getMoney() * ConversionRate::TAX_LARGER_THREE_THOUSAND
            );
        }
    }

    public function test_should_to_check_fee_conversion_rate_when_money_smaller_3000(): void
    {
        foreach ($this->getMoneySmallerThreeThousandObjects() as $money) {
            $conversionRate = (new ConversionRate($money))->getFees();
            $this->assertEquals(
                $conversionRate, $money->getMoney() * ConversionRate::TAX_SMALLER_THREE_THOUSAND
            );
        }
    }

    private function getMoneyLargerThreeThousandObjects(): array
    {
        return [
            new Money(['money' => 5000]),
            new Money(['money' => 10000]),
            new Money(['money' => 70000]),
            new Money(['money' => 45372]),
        ];
    }

    private function getMoneySmallerThreeThousandObjects(): array
    {
        return [
            new Money(['money' => 1010]),
            new Money(['money' => 1500]),
            new Money(['money' => 2000]),
            new Money(['money' => 2500]),
        ];
    }
}