<?php

namespace Converter\Rules;

use Converter\Services\ConverterService;
use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Http\Request;

class PaymentRangeRule implements ImplicitRule
{
    protected object $paymentRange;
    protected float $minValue;
    protected float $maxValue;
    protected string $message = 'Invalid payment';

    public function __construct(
        protected ConverterService $converterService,
        protected Request $request
    )
    {
        $this->paymentRange = (object) [
            'minValue' => env('MIN_PAYMENT_VALUE'),
            'maxValue' => env('MAX_PAYMENT_VALUE')
        ];
    }

    public function passes($attribute, $value) : bool
    {
        $currency = $this->request->input('currency');
        $convertedValue = $this->converterService->convertWithRange($currency, $value);

        if(!$convertedValue) {
            return $convertedValue;
        }

        $moreThanMax = $convertedValue['value'] > $this->paymentRange->maxValue;
        $lessThanMin = $convertedValue['value'] < $this->paymentRange->minValue;

        if($moreThanMax) {
            $this->message = "Payments with this currency must be at most {$convertedValue['max']} {$currency}";
        } elseif ($lessThanMin) {
            $this->message = "Payments with this currency must be at least {$convertedValue['min']} {$currency}";
        } 

        return !$moreThanMax && !$lessThanMin;
    }

    public function message() : string
    {
        return $this->message;
    }
}