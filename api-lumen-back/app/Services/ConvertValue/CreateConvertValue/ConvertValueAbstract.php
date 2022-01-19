<?php

namespace App\Services\ConvertValue\CreateConvertValue;

use App\Models\ConvertedValue;
use App\Models\Enum\CurrencyEnum;
use App\Models\Enum\PaymentMethodEnum;
use App\Traits\ApiGatewayAwesome;
use Illuminate\Support\Facades\Auth;

abstract class ConvertValueAbstract extends ConvertValueBase
{

    use ApiGatewayAwesome;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function execConvertion() :? ConvertedValue
    {
        $originValue = $this->params['originValue'];
        $paymentMethod = $this->params['paymentMethod'];

        $discountPaymentMethod = $this->getTaxByPaymentMethodCalculated($originValue, $paymentMethod);
        $discountAmount = $this->getTaxByAmountCalculated($originValue);
        $updatedValue = $this->calculateValueConverted($originValue, $paymentMethod);
        $convertedCurrency = CurrencyEnum::fromKey($this->params['convertedCurrency']);
        $currentQuote = $this->getCurrentQuote($convertedCurrency, 'BRL');

        $data = [
            'origin_value'          => $originValue,
            'origin_currency'       => 'BRL',
            'converted_value'       => $updatedValue / $currentQuote,
            'converted_currency'    => $convertedCurrency,
            'payment_method'        => $paymentMethod,
            'tenant_id'             => Auth::user()->id,
            'tax_conversion'        => $discountAmount,
            'tax_payment_method'    => $discountPaymentMethod,
            'tax_currency'          => (float)$currentQuote,
            'updated_value'         => $updatedValue
        ];

        return $this->convertedValueRepository->createConvertedValue($data);
    }

    /**
     * Undocumented function
     *
     * @param string $paymentMethod
     * @return float
     */
    private function getTaxByPaymentMethod(string $paymentMethod) : float
    {
        $paymentMethodEnum = new PaymentMethodEnum();

        switch ($paymentMethod) {
            case $paymentMethodEnum::CREDIT_CARD:
                return 7.63;
                break;
            case $paymentMethodEnum::BANK_SLIP:
                return 1.45;
                break;

            default:
                return 0;
                break;
        }
    }

    /**
     * Undocumented function
     *
     * @param float $originValue
     * @return float
     */
    private function getTaxByAmount(float $originValue) : float
    {
        if($originValue <= 3000){
            return 2;
        }else{
            return 1;
        }
    }

    /**
     * Undocumented function
     *
     * @param float $valueOrigin
     * @return float
     */
    private function getTaxByAmountCalculated(float $valueOrigin) : float
    {
        return ($valueOrigin / 100) * $this->getTaxByAmount($valueOrigin);
    }

    /**
     * Undocumented function
     *
     * @param float $valueOrigin
     * @param string $paymentMethod
     * @return float
     */
    private function getTaxByPaymentMethodCalculated(float $valueOrigin, string $paymentMethod) : float
    {
        return ($valueOrigin / 100) * $this->getTaxByPaymentMethod($paymentMethod);
    }

    /**
     * Undocumented function
     *
     * @param float $valueOrigin
     * @param string $paymentMethod
     * @return float
     */
    private function calculateValueConverted(float $valueOrigin, string $paymentMethod) : float
    {
        $discountPaymentMethod = $this->getTaxByPaymentMethodCalculated($valueOrigin, $paymentMethod);
        $discountAmount = $this->getTaxByAmountCalculated($valueOrigin);

        $valueUpdated = $valueOrigin - $discountPaymentMethod - $discountAmount;

        return $valueUpdated;
    }
}
