<?php

namespace App\Tasks;

use Exception;
use TaxModel;
use App\Services\ApplyCurrencyConvertTaxService;
use App\Exceptions\CurrencyConvertException;

class ApplyCurrencyConvertertTaxTask
{
    public function run(array $convertData, float $value): array
    {
        try {
            $taxes = (new TaxModel)->getConvertTaxes();

            $percent = null;
            array_walk($taxes, function ($tax) use ($value, &$percent) {
                if ($value >= $tax->min && $value <= $tax->max) {
                    $percent = $tax->tax_percent;
                    return true;
                }
            });

            if (empty($percent)) {
                throw new CurrencyConvertException();
            }

            return (new ApplyCurrencyConvertTaxService())
                ->withConvert($convertData)
                ->withValue($value)
                ->withTax($percent)
                ->apply();
        } catch (Exception $e) {
            log_error($e);
            return false;
        }
    }
}
