<?php

namespace Modules\Converter\Services\Contracts;

use Modules\Converter\Entities\ConversionHistory;

interface ConverterServiceInterface
{
    /**
     * @param string $destinationCurrency
     * @param float $value
     * @return array
     */
    public function makeConversion(string $destinationCurrency, float $value): array;

    /**
     * @param string $destinationCurrency
     * @return float
     */
    public function getDestinationCurrencyValue(string $destinationCurrency): float;

    /**
     * @param float $destinationCurrencyValue
     * @param float $sourceCurrencyValue
     * @return float
     */
    public function calcPurchasedValue(float $destinationCurrencyValue, float $sourceCurrencyValue): float;

    /**
     * @param array $conversionData
     * @return ConversionHistory
     */
    public function recordConversionHistory(array $conversionData): ConversionHistory;

    /**
     * @param integer $conversionHistoryId
     * @return ConversionHistory
     */
    public function getConversionHistoryById(int $conversionHistoryId): ConversionHistory;
}
