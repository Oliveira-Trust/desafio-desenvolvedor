<?php

declare(strict_types=1);

namespace App\Builders\Conversion;

use App\Enumerators\Domain;
use App\Exceptions\ConversionException;
use App\Facades\Helpers;
use App\Reads\ConversionValuesInterface;

class Conversion
{
    private const BASE_CALC_BID = 1.00;

    private CurrencyBuilder $currency;
    private PaymentBuilder $payment;

    public function __construct(
        private readonly ConversionValuesInterface $conversionValues,
        private array $quotation
    ) {
        $this->currency = new CurrencyBuilder($conversionValues);
        $this->payment = new PaymentBuilder($conversionValues);
    }

    /** @throws \Throwable */
    public function result(): array
    {
        $bid = array_shift($this->quotation)['bid'] ?? null;

        throw_unless($bid, ConversionException::errorConversion());

        $currency = $this->currency->getValues();
        $payment =  $this->payment->getValues();
        $defaultRate = (float)Domain::DEFAULT_CONVERSION_RATE->value;
        $conversionRate = $defaultRate + ($payment['payment_rate'] ?? 0.00);
        $amountUsedConversion = $this->conversionValues->amount() - $conversionRate ;

        return  [
            ...$currency,
            ...$payment,
            'amount_destination_currency' => self::BASE_CALC_BID / ((float)$bid),
            'amount_currency_purchased' => $this->conversionValues->amount() * $bid,
            'conversion_rate' => $defaultRate,
            'amount_used_conversion' => $amountUsedConversion,
            'user_id' => Helpers::authUser()->first()->id
        ];
    }
}
