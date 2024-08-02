<?php

declare(strict_types=1);

namespace Module\Broker\Entities;

use Module\Broker\Enums\PaymentMethod;
use Module\Broker\Exceptions\CurrencyAmountException;
use Module\Broker\Exceptions\CurrencyDestinationException;

final readonly class Invoice
{
    const CURRENCY_ORIGIN_DEFAULT = 'BRL';

    const MINIMUM_AMOUNT_IN_CENTS = 100000;

    const MAXIMUM_AMOUNT_IN_CENTS = 10000000;

    private string $currencyOrigin;

    /**
     * @throws CurrencyAmountException
     * @throws CurrencyDestinationException
     */
    private function __construct(
        private Uuid $id,
        private string $currencyDestination,
        private int $amountInCents,
        private PaymentMethod $paymentMethod,
    ) {
        $this->validate();
        $this->currencyOrigin = self::CURRENCY_ORIGIN_DEFAULT;
    }

    public static function create(string $currencyDestination, int $amountInCents, string $paymentMethod): self
    {
        return new self(
            id: Uuid::generate(),
            currencyDestination: $currencyDestination,
            amountInCents: $amountInCents,
            paymentMethod: PaymentMethod::from($paymentMethod)
        );
    }

    public function amountInCents(): int
    {
        return $this->amountInCents;
    }

    public function currencyOrigin(): string
    {
        return $this->currencyOrigin;
    }

    public function currencyDestination(): string
    {
        return $this->currencyDestination;
    }

    public function paymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    /**
     * @throws CurrencyAmountException
     * @throws CurrencyDestinationException
     */
    private function validate(): void
    {
        if ($this->amountInCents <= self::MINIMUM_AMOUNT_IN_CENTS) {
            throw new CurrencyAmountException('Amount invoice must be greater than '.number_format(self::MINIMUM_AMOUNT_IN_CENTS / 100, 2, ',', '.'));
        }
        if ($this->amountInCents > self::MAXIMUM_AMOUNT_IN_CENTS) {
            throw new CurrencyAmountException('Amount invoice must be less than '.number_format(self::MAXIMUM_AMOUNT_IN_CENTS / 100, 2, ',', '.'));
        }
        if ($this->currencyDestination === self::CURRENCY_ORIGIN_DEFAULT) {
            throw new CurrencyDestinationException('Currency destination of invoice must be different of '.self::CURRENCY_ORIGIN_DEFAULT);
        }
    }
}
