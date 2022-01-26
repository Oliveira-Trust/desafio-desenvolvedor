<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\BankInvoice;
use App\Models\Money;
use Tests\TestCase;

class BankInvoiceTest extends TestCase
{
    public function test_should_get_fee_of_bank_invoice(): void
    {
        foreach ($this->getMoneyObjects() as $money) {
            $bankInvoiceFee = (new BankInvoice($money))->getValueFees();
            $this->assertEquals($bankInvoiceFee, $money->getMoney() * BankInvoice::TAX);
        }
    }

    public function getMoneyObjects(): array
    {
        return [
            new Money(['money' => 5000]),
            new Money(['money' => 10000]),
            new Money(['money' => 70000]),
            new Money(['money' => 45372]),
        ];
    }
}