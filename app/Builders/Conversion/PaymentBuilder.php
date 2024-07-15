<?php

declare(strict_types=1);

namespace App\Builders\Conversion;

use App\Exceptions\ConversionException;
use App\Models\Payment;
use App\Reads\ConversionValuesInterface;
use App\Repository\PaymentRepository;

class PaymentBuilder
{
    private ConversionValuesInterface $conversionValues;
    private PaymentRepository $paymentRepository;

    public function __construct(ConversionValuesInterface $conversionValues)
    {
        $this->conversionValues = $conversionValues;
        $this->paymentRepository = new PaymentRepository();
    }

    /**
     * @throws \Throwable
     */
    public function getValues(): array
    {
        $payment = $this->validate();
        $value = $this->conversionValues->amount() * ($payment->rate * 0.0100);

        return [
            'payment_id' => $payment->id,
            'payment_type' => __("messages.{$this->conversionValues->payment()}", locale: 'pt_BR'),
            'payment_rate' => $value,
        ];
    }

    /**
     * @throws \Throwable
     */
    private function validate(): Payment
    {
        $payment = $this->paymentRepository->findBy([
            'slug' => $this->conversionValues->payment()
        ])->first();

        throw_unless($payment instanceof Payment, ConversionException::paymentNotFound());

        return $payment;
    }
}
