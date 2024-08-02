<?php

declare(strict_types=1);

namespace Module\Broker\UseCases;

final readonly class OutputTransaction
{
    public function __construct(
        public string $currencyOrigin,
        public string $currencyDestination,
        public int $amountConversion,
        public string $paymentMethod,
        public int $amountCurrencyDestinationForConversion,
        public float|int $amountPurchasedCurrencyDestination,
        public int $amountFeeOfPayment,
        public int $amountFeeOfConversion,
        public int $amountUsedForConversionDiscountFee,
    ) {}
}
