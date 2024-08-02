<?php

declare(strict_types=1);

namespace Module\Broker\Entities;

final class Transaction
{
    private int $feePaymentMethod;

    private int $feeConversion;

    private float $purchasedCurrencyDestination;

    private function __construct(
        private readonly Invoice $invoice,
        private readonly int $rateConversion,
        private readonly ConversionFeeCalculator $conversionFeeCalculator,
        private readonly FeePaymentInterface $feePayment,
    ) {
        $this->feePaymentMethod = 0;
        $this->feeConversion = 0;
        $this->purchasedCurrencyDestination = 0;
        $this->calculateAmountFeeConversion($this->conversionFeeCalculator);
        $this->calculateAmountFeePaymentMethod($this->feePayment);
        $this->calculateAmountPurchasedCurrencyDestination();
    }

    public static function create(Invoice $invoice, int $rateConversion, ConversionFeeCalculator $conversionFeeCalculator, FeePaymentInterface $feePayment): Transaction
    {
        return new self(
            invoice: $invoice,
            rateConversion: $rateConversion,
            conversionFeeCalculator: $conversionFeeCalculator,
            feePayment: $feePayment
        );
    }

    private function calculateAmountFeeConversion(ConversionFeeCalculator $conversionFeeCalculator): void
    {
        $this->feeConversion = $conversionFeeCalculator->apply($this->invoice);
    }

    private function calculateAmountFeePaymentMethod(FeePaymentInterface $feePayment): void
    {
        $this->feePaymentMethod = $feePayment->calculate($this->invoice);
    }

    private function calculateAmountPurchasedCurrencyDestination(): void
    {
        $this->purchasedCurrencyDestination = (float) number_format($this->getAmountAfterApplyFees() / $this->rateConversion, 2, '.', '');
    }

    public function getFeeConversion(): int
    {
        return $this->feeConversion;
    }

    public function getFeePaymentMethod(): int
    {
        return $this->feePaymentMethod;
    }

    public function getAmountAfterApplyFees(): int
    {
        return $this->invoice->amountInCents() - $this->feePaymentMethod - $this->feeConversion;
    }

    public function getPurchasedCurrencyDestination(): float|int
    {
        return $this->purchasedCurrencyDestination;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function getRateConversion(): int
    {
        return $this->rateConversion;
    }
}
