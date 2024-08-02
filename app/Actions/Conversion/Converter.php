<?php

namespace App\Actions\Conversion;

use App\Actions\Action;
use App\Actions\ConversionRate\GetConversionRate;
use App\Actions\PaymentMethod\GetPaymentTax;
use App\Actions\PaymentMethod\GetPaymentTitle;
use App\Jobs\SaveQuoteHistory;
use App\Notifications\SendQuoteByEmail;
use App\Services\AwesomeAPI\Quote;
use Illuminate\Support\Facades\Notification;

class Converter extends Action
{
    public function handle(float $amount, string $originCurrency, string $destinationCurrency, string $paymentMethod): array
    {
        $quote = new Quote($originCurrency, $destinationCurrency);
        $purchasePrice = $quote->handle();

        $paymentTitle = GetPaymentTitle::run($paymentMethod);
        $paymentTax = GetPaymentTax::run($amount, $paymentMethod);
        $conversionRate = GetConversionRate::run($amount);

        $destinationValue = $this->calculateDestinationValue($purchasePrice);

        $conversionTax = $this->calculateConversionTax($amount, $conversionRate);
        $convertedAmount = $this->calculateConvertedAmount($amount, $paymentTax, $conversionTax);
        $convertedValue = $this->calculateConvertedValue($purchasePrice, $convertedAmount);

        $data = [
            'data' => [
                'origin_currency' => $originCurrency,
                'destination_currency' => $destinationCurrency,
                'amount' => $amount,
                'payment_title' => $paymentTitle,
                'purchase_price' => $purchasePrice,
                'destination_value' => $destinationValue,
                'converted_value' => $convertedValue,
                'payment_tax' => $paymentTax,
                'conversion_tax' => $conversionTax,
                'converted_amount' => $convertedAmount,
            ],
        ];

        $this->executeJobs($data['data']);
        $this->executeNotifications($data['data']);

        return $data;
    }

    private function calculateDestinationValue(float $purchasePrice): float
    {
        return (float) number_format(1 / $purchasePrice, 2);
    }

    private function calculateConversionTax(float $amount, float $conversionRate): float
    {
        return ($amount * $conversionRate) / 100;
    }

    private function calculateConvertedAmount(float $amount, float $paymentTax, float $conversionTax): float
    {
        return $amount - $paymentTax - $conversionTax;
    }

    private function calculateConvertedValue(float $purchasePrice, float $totalAmount): float
    {
        return $purchasePrice * $totalAmount;
    }

    private function executeJobs(array $data): void
    {
        SaveQuoteHistory::dispatch(
            auth()->user()?->id,
            $data
        );
    }

    private function executeNotifications(array $data): void
    {
        if (auth()->check()) {
            Notification::route('mail', auth()->user()->email)
                ->notify(new SendQuoteByEmail($data));
        }
    }
}
