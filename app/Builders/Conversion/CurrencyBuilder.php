<?php

declare(strict_types=1);

namespace App\Builders\Conversion;

use App\Enumerators\Domain;
use App\Exceptions\ConversionException;
use App\Facades\Helpers;
use App\Reads\ConversionValuesInterface;

class CurrencyBuilder
{
    private const RANGE_PURCHASE = [1000, 1000];

    private ConversionValuesInterface $conversionValues;

    public function __construct(ConversionValuesInterface $conversionValues)
    {
        $this->conversionValues = $conversionValues;
    }

    /** @throws \Throwable */
    public function getValues(): array
    {
        $this->validate();

        return [
            'origin_currency' => $this->conversionValues->from(),
            'destiny_currency' => $this->conversionValues->to(),
            'conversion_amount' => $this->conversionValues->amount()
        ];
    }

    /** @throws \Throwable */
    private function validate(): void
    {
        if($this->conversionValues->to() === Domain::DEFAULT_CURRENCY->value) {
            return;
        }

        $hasRange = Helpers::hasValueBetween(self::RANGE_PURCHASE, $this->conversionValues->amount());

        throw_unless($hasRange, ConversionException::outOfRange());
    }
}
