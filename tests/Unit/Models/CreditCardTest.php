<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\CreditCard;
use App\Models\Money;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    public function test_should_to_check_fee_credit_card(): void
    {
        foreach ($this->getMoneyObjects() as $money) {
            $creditCardFee = (new CreditCard($money))->getValueFees();
            $this->assertEquals($creditCardFee, $money->getMoney() * CreditCard::TAX);
        }
    }

    private function getMoneyObjects(): array
    {
        return [
            new Money(['money' => 5000]),
            new Money(['money' => 10000]),
            new Money(['money' => 70000]),
            new Money(['money' => 45372]),
        ];
    }
}