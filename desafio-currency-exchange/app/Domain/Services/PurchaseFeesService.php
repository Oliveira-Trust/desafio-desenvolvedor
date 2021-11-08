<?php


namespace App\Domain\Services;


use App\Models\Exchange;

class PurchaseFeesService
{
    private CONST RATES_APPLIED_FOR_CREDIT_CARD = 0.0763;
    private CONST RATES_APPLIED_FOR_BANK_SLIP = 0.0145;
    private CONST RATES_APPLIED_FOR_VALUE_DOWN = 0.02;
    private CONST RATES_APPLIED_FOR_VALUE_UP = 0.01;

    /**
     * @param mixed[] $payload
     * @return mixed[]
     */
    public function applyChargesForPurchase(array $payload): array
    {
        $payload['rate_payment'] = $this->chargesForPaymentType($payload);
        $payload['rate_value'] = $this->chargesForValue($payload);
        $payload['final_value'] = $this->applyChargesForValuePurchase($payload);

        return $payload;
    }

    /**
     * @param mixed[] $payload
     * @return float
     */
    private function chargesForPaymentType(array $payload): float
    {
        $type = data_get($payload, 'type_payment');
        $value = (float)data_get($payload, 'value_exchange');

        $ratePayment = (
            $type === Exchange::BILLING_TYPE['CREDIT_CARD'] ?
            self::RATES_APPLIED_FOR_CREDIT_CARD * $value :
            self::RATES_APPLIED_FOR_BANK_SLIP * $value
        );

        return $ratePayment;
    }

    /**
     * @param mixed[] $payload
     * @return float
     */
    private function chargesForValue(array $payload): float
    {
        $value = (float)data_get($payload, 'value_exchange');

        $rateValue = (
            $value > Exchange::VALUE_FOR_RATE ?
            self::RATES_APPLIED_FOR_VALUE_UP * $value :
            self::RATES_APPLIED_FOR_VALUE_DOWN * $value
        );

        return $rateValue;
    }

    /**
     * @param mixed[] $payload
     */
    private function applyChargesForValuePurchase(array $payload): float
    {
        $valueExchange = data_get($payload, 'value_exchange');
        $valueRatePayament = data_get($payload, 'rate_payment');
        $valueRateValue = (float)data_get($payload, 'rate_value');

        return $valueExchange - ($valueRatePayament + $valueRateValue);
    }

}
