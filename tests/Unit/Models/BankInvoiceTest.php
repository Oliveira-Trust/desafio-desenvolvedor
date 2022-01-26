<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\BankInvoice;
use App\Models\Money;
use Tests\TestCase;

class BankInvoiceTest extends TestCase
{
    public function test_sim(): void
    {
        $attributes['money'] = 5000;
        (new BankInvoice(new Money($attributes)))->getValueFees();
    }
}