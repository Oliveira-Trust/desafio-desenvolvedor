<?php

namespace Domain\Fees\Actions;

use Domain\Fees\Models\Fees;

final class CalculationPaymentFeesAction
{
    public function __invoke(Fees $fees, float $value)
    {
        return (floatval($fees->percentage) / 100) * $value;
    }
}
