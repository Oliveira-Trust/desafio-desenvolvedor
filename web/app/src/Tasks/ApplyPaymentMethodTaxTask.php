<?php

namespace App\Tasks;

use Exception;
use PaymentModel;
use App\Services\ApplyPaymentMethodTaxService;
use App\Exceptions\PaymentMethodBuilderException;

class ApplyPaymentMethodTaxTask
{
    public function run(array $convertData, float $value, int $paymentType): array
    {
        try {
            $percent = (new PaymentModel)->getPaymentByType($paymentType);
            $percent = reset($percent);

            if (empty($percent->tax)) {
                throw new PaymentMethodBuilderException();
            }

            return (new ApplyPaymentMethodTaxService())
                ->withConvert($convertData)
                ->withValue($value)
                ->withTax($percent->tax)
                ->apply();
        } catch (Exception $e) {
            log_error($e);
            return false;
        }
    }
}
