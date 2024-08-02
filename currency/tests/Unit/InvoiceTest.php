<?php

declare(strict_types=1);

use Module\Broker\Entities\Invoice;
use Module\Broker\Entities\Uuid;
use Module\Broker\Enums\PaymentMethod;
use Module\Broker\Exceptions\CurrencyAmountException;
use Module\Broker\Exceptions\CurrencyDestinationException;

it('should create instance invoice', function () {
    $invoice = Invoice::create('EUR', 100001, 'credit_card');
    expect($invoice)->toBeInstanceOf(Invoice::class)
        ->and($invoice->id())->toBeInstanceOf(Uuid::class)
        ->and($invoice->id()->value)->toBeString()
        ->and($invoice->currencyOrigin())->toBe('BRL')
        ->and($invoice->currencyDestination())->toBe('EUR')
        ->and($invoice->amountInCents())->toBe(100001)
        ->and($invoice->paymentMethod())->toBe(PaymentMethod::CREDIT_CARD)
        ->and($invoice->paymentMethod()->value)->toBe('credit_card');
});

it('should create instance invoice with default currency origin equals BRL', function () {
    $invoice = Invoice::create('EUR', 100001, 'credit_card');
    expect($invoice->currencyOrigin())->toEqual('BRL');
});

it('should throw exception when amount invoice is less than 1.000,00', function () {
    expect(fn () => Invoice::create('EUR', 10000, 'bank_slip'))
        ->toThrow(CurrencyAmountException::class, 'Amount invoice must be greater than 1.000,00');
});

it('should throw exception when amount invoice is greater than or equal 100.000,00', function () {
    expect(fn () => Invoice::create('EUR', 20000000, 'bank_slip'))
        ->toThrow(CurrencyAmountException::class, 'Amount invoice must be less than 100.000,00');
});

it('should throw exception when currency destination is equal BRL', function () {
    expect(fn () => Invoice::create('BRL', 100001, 'bank_slip'))
        ->toThrow(CurrencyDestinationException::class, 'Currency destination of invoice must be different of BRL');
});
