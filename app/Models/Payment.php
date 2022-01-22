<?php

declare(strict_types=1);

namespace App\Models;

abstract class Payment
{
    abstract public function getValueFees(): float;
}
