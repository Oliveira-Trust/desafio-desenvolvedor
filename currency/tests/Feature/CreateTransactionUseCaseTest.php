<?php

declare(strict_types=1);

use App\FakeTransaction;
use Module\Broker\Gateway\FakeEURCurrencyConvertGateway;
use Module\Broker\Gateway\FakeNotification;
use Module\Broker\Gateway\FakeUSDCurrencyConvertGateway;
use Module\Broker\UseCases\CreateTransactionUseCase;
use Module\Broker\UseCases\InputTransaction;

it('should create transaction with payment method bank_slip', function () {
    $gateway = new FakeUSDCurrencyConvertGateway;
    $repository = new FakeTransaction;
    $gatewayEmail = new FakeNotification;
    $useCase = new CreateTransactionUseCase($gateway, $repository, $gatewayEmail);
    $output = $useCase->execute(new InputTransaction(
        currencyDestination: 'USD',
        amount: 500000,
        paymentMethod: 'bank_slip'
    ));
    expect($output->currencyOrigin)->toEqual('BRL');
    expect($output->currencyDestination)->toEqual('USD');
    expect($output->amountConversion)->toEqual(500000);
    expect($output->paymentMethod)->toEqual('bank_slip');
    expect($output->amountCurrencyDestinationForConversion)->toEqual(530);
    expect($output->amountPurchasedCurrencyDestination)->toEqual(920.28);
    expect($output->amountFeeOfPayment)->toEqual(7250);
    expect($output->amountFeeOfConversion)->toEqual(5000);
    expect($output->amountUsedForConversionDiscountFee)->toEqual(487750);
});

it('should create transaction with payment method credit_card', function () {
    $repository = new FakeTransaction;
    $gatewayEmail = new FakeNotification;
    $useCase = new CreateTransactionUseCase(new FakeEURCurrencyConvertGateway, $repository, $gatewayEmail);
    $output = $useCase->execute(new InputTransaction(
        currencyDestination: 'EUR',
        amount: 1000000,
        paymentMethod: 'credit_card'
    ));
    expect($output->currencyOrigin)->toEqual('BRL');
    expect($output->currencyDestination)->toEqual('EUR');
    expect($output->amountConversion)->toEqual(1000000);
    expect($output->paymentMethod)->toEqual('credit_card');
    expect($output->amountCurrencyDestinationForConversion)->toEqual(607);
    expect($output->amountPurchasedCurrencyDestination)->toEqual(1505.27);
    expect($output->amountFeeOfPayment)->toEqual(76300);
    expect($output->amountFeeOfConversion)->toEqual(10000);
    expect($output->amountUsedForConversionDiscountFee)->toEqual(913700);
});
