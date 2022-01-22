<?php

declare(strict_types=1);

namespace App\Models;

abstract class Payment
{
    abstract protected function tax(Money $money): float;
}
