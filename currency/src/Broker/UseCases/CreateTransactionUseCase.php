<?php

namespace Module\Broker\UseCases;

use Module\Broker\Entities\ConversionValuesForRatesGreaterThanThreeThousand;
use Module\Broker\Entities\FeeConversionValuesLessThanThreeThousand;
use Module\Broker\Entities\Invoice;
use Module\Broker\Entities\Transaction;
use Module\Broker\Factories\CalculatorFeePaymentFactory;
use Module\Broker\Gateway\CurrencyConvertGateway;
use Module\Broker\Gateway\NotificationInterface;
use Module\Broker\Repository\TransactionRepository;

final readonly class CreateTransactionUseCase
{
    public function __construct(
        private CurrencyConvertGateway $currencyConvertGateway,
        private TransactionRepository $repository,
        private NotificationInterface $notification,
    ) {}

    public function execute(InputTransaction $input): OutputTransaction
    {
        $invoice = Invoice::create(
            currencyDestination: $input->currencyDestination,
            amountInCents: $input->amount,
            paymentMethod: $input->paymentMethod
        );
        $valueToConversion = $this->currencyConvertGateway->convert(to: $input->currencyDestination);
        $calculateFeeConversion = new FeeConversionValuesLessThanThreeThousand(new ConversionValuesForRatesGreaterThanThreeThousand(null));
        $calculator = CalculatorFeePaymentFactory::make($input->paymentMethod);
        $transaction = Transaction::create($invoice, $valueToConversion, $calculateFeeConversion, $calculator);
        $this->repository->save($transaction);
        $this->notification->send($transaction);

        return new OutputTransaction(
            currencyOrigin: 'BRL',
            currencyDestination: $input->currencyDestination,
            amountConversion: $input->amount,
            paymentMethod: $input->paymentMethod,
            amountCurrencyDestinationForConversion: $valueToConversion,
            amountPurchasedCurrencyDestination: $transaction->getPurchasedCurrencyDestination(),
            amountFeeOfPayment: $transaction->getFeePaymentMethod(),
            amountFeeOfConversion: $transaction->getFeeConversion(),
            amountUsedForConversionDiscountFee: $transaction->getAmountAfterApplyFees()
        );
    }
}
