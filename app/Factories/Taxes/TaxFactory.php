<?php

namespace App\Factories\Taxes;

use App\Contracts\TaxContract;

class TaxFactory
{
    const KEY = 'services.currency-conversion.strategies.taxes';

    /**
     * @return TaxContract[]
     */
    public static function factory(): array
    {
        $enabled = config(self::KEY);

        $strategies = [];
        foreach ($enabled as $strategy) {
            /** @var TaxContract[] $strategies */
            $strategies[] = app($strategy);
        }

        return $strategies;
    }
}
