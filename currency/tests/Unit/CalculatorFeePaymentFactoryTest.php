<?php

declare(strict_types=1);

use Module\Broker\Entities\BankSlipFeePaymentCalculator;
use Module\Broker\Entities\CreditCardFeePaymentCalculator;
use Module\Broker\Entities\Invoice;
use Module\Broker\Factories\CalculatorFeePaymentFactory;

it('should return an instance of BankSlipFeePaymentCalculator', function () {
    $calculator = CalculatorFeePaymentFactory::make('bank_slip');
    expect($calculator)->toBeInstanceOf(BankSlipFeePaymentCalculator::class);
});

it('should return an instance of CreditCardFeePaymentCalculator', function () {
    $calculator = CalculatorFeePaymentFactory::make('credit_card');
    expect($calculator)->toBeInstanceOf(CreditCardFeePaymentCalculator::class);
});

it('should throw an exception when payment method is invalid', function () {
    expect(fn () => CalculatorFeePaymentFactory::make('invalid_payment_method'))
        ->toThrow(InvalidArgumentException::class, 'Invalid payment method');
});

it('should calculate fee for bank_slip payment', function () {
    $calculator = CalculatorFeePaymentFactory::make('bank_slip');
    $fee = $calculator->calculate(Invoice::create('USD', 500000, 'bank_slip'));
    expect($fee)->toEqual(7250);
});

it('should calculate fee for credit_card payment', function () {
    $calculator = CalculatorFeePaymentFactory::make('credit_card');
    $fee = $calculator->calculate(Invoice::create('USD', 500000, 'credit_card'));
    expect($fee)->toEqual(38150);
});
