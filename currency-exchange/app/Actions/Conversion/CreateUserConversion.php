<?php

namespace app\Actions\Conversion;

use App\DTO\CreateExchangeDTO;
use App\Models\Conversion;
use App\Models\Fee;
use App\Models\PaymentMethod;
use App\Services\ExchangeApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConversionCreated;

class CreateUserConversion
{
    private ExchangeApi $exchangeApi;

    public function __construct(ExchangeApi $exchangeApi) {
        $this->exchangeApi = $exchangeApi;
    }

    public function execute(CreateExchangeDTO $dto)
    {
        $value = $this->defaultNumberFormat($dto->value);

        $conversionFeeAmount = $this->calcConversionFee($value);

        $paymentFeeAmount = $this->calcPaymentFee($dto->paymentMethod, $value);

        $targetCurrency = $this->exchangeApi->request($dto->targetCurrency);

        $effectiveValue = $value - $conversionFeeAmount - $paymentFeeAmount;

        $value = ($effectiveValue / $targetCurrency->bid);

        $data = [
            'base_currency' => $dto->baseCurrency,
            'target_currency' => $dto->targetCurrency,
            'user_id' => auth()->user()->id,
            'value' => $dto->value,
            'payment_method_id' => $dto->paymentMethod,
            'target_currency_value' => $this->defaultNumberFormat($targetCurrency->bid),
            'purchased_value' => $this->defaultNumberFormat($value),
            'payment_fee' => $this->defaultNumberFormat($paymentFeeAmount),
            'conversion_fee' => $this->defaultNumberFormat($conversionFeeAmount),
            'effective_value' => $this->defaultNumberFormat($effectiveValue)
        ];

        $conversion = Conversion::create($data);

        // Send email
        Mail::to(auth()->user()->email)->send(new ConversionCreated($conversion));

        return $conversion;
    }

    private static function calcConversionFee($value){
        $fee = Fee::all()->filter(function ($item) use ($value) {
            return $item->threshold <= $value;
        })->sortByDesc('threshold')->first();
        $rate = $fee->rate;

        return $rate/100 * $value;
    }

    private static function calcPaymentFee($paymentMethod, $value){
        $paymentMethod = PaymentMethod::findOrFail($paymentMethod);
        $rate = $paymentMethod->fee;

        return $rate/100 * $value;
    }

    private function defaultNumberFormat($value)
    {
        return number_format($value, 2, '.', '');
    }
}
