<?php

namespace App\Services;

use App\Events\ExchangeCreated;
use App\Models\ExchangeFeeConfiguration;
use App\Models\PaymentMethod;
use App\Models\Exchange;
use App\Services\AwesomeAPI\AwesomeAPIService;
use App\Services\AwesomeAPI\Exceptions\CurrencyQuoteNotFoundException;
use Illuminate\Support\Facades\DB;

readonly class ExchangeService
{
    function __construct(private AwesomeAPIService $awesomeAPIService) { }

    /**
     * Convert the given amount from BRL to the target currency applying the specified payment method fees and conversion fees.
     *
     * @param string $destinationCurrency
     * @param float $amount
     * @param string $paymentMethodCode
     * @param int $userId
     * @return Exchange
     * @throws CurrencyQuoteNotFoundException
     * @throws \Exception
     */
    public function convert(string $destinationCurrency, float $amount, string $paymentMethodCode, int $userId): Exchange
    {
        if ($destinationCurrency === 'BRL') {
            throw new \Exception("Destination currency cannot be BRL.");
        }

        if ($amount < 1000 || $amount > 100000) {
            throw new \Exception("The amount must be between 1000 and 100000 BRL.");
        }

        $paymentFee = $this->getPaymentMethodFee($paymentMethodCode, $amount);
        $conversionFee = $this->getConversionFee($amount);

        try {
            $quote = $this->awesomeAPIService->getCurrencyQuote('BRL', $destinationCurrency);
        } catch (CurrencyQuoteNotFoundException $e) {
            throw new \Exception("Currency quote for {$destinationCurrency} not found.");
        }

        $totalWithFees = $amount - $paymentFee - $conversionFee;
        $convertedAmount = $totalWithFees / $quote->buyRate;

        try {
            DB::beginTransaction();

            $userConversion = Exchange::create([
                'user_id' => $userId,
                'source_currency' => 'BRL',
                'destination_currency' => $destinationCurrency,
                'original_amount' => $amount,
                'payment_method' => $paymentMethodCode,
                'amount_in_destination_currency' => $convertedAmount,
                'payment_method_fee' => $paymentFee,
                'conversion_fee' => $conversionFee,
                'total_with_fees' => $totalWithFees,
            ]);

            DB::commit();

            event(new ExchangeCreated($userConversion));

            return $userConversion;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function getConversionsHistoryByUserId(int $userId)
    {
        return Exchange::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get the payment method fee based on the amount.
     *
     * @param string $paymentMethodCode
     * @param float $amount
     * @return float
     * @throws \Exception
     */
    private function getPaymentMethodFee(string $paymentMethodCode, float $amount): float
    {
        if (!$paymentMethod = PaymentMethod::find($paymentMethodCode)) {
            throw new \Exception('Payment method not found.');
        }

        return $amount * $paymentMethod->fee / 100;
    }

    /**
     * Get the conversion fee based on the amount.
     *
     * @param float $amount
     * @return float
     * @throws \Exception
     */
    private function getConversionFee(float $amount): float
    {
        if (!$conversionFee = ExchangeFeeConfiguration::getActive()) {
            throw new \Exception('Conversion fee not found.');
        }

        // NOTE: O enunciado do desafio não deixa claro o que fazer quando a taxa for igual ao limite, portanto, optei por uma das opções
        $fee = $amount <= $conversionFee->amount_threshold
            ? $conversionFee->lower_than_threshold / 100
            : $conversionFee->greater_than_threshold / 100;

        return $amount * $fee;
    }
}
