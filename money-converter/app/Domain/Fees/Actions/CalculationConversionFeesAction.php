<?php

namespace Domain\Fees\Actions;

final class CalculationConversionFeesAction
{
    public function __invoke(float $value): float
    {
        if ($value <= 3000) {
            return (2.0 / 100) * $value;
        }

        return (1.0 / 100) * $value;
    }
}
