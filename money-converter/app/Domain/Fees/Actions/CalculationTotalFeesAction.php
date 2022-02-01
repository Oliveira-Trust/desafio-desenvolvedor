<?php

namespace Domain\Fees\Actions;

final class CalculationTotalFeesAction
{
    public function __invoke(array $fees): float
    {
        return array_reduce($fees, function ($value, $fees) {
            $value += $fees;
            return $value;
        });
    }
}
