<?php

declare(strict_types=1);

namespace App;

use Module\Broker\Entities\Transaction;
use Module\Broker\Repository\TransactionRepository;

class TransactionEloquentRepository implements TransactionRepository
{
    public function save(Transaction $transaction): void
    {
        \App\Models\Transaction::create(
            [
                'invoice_id' => $transaction->getInvoice()->id()->value,
                'user_id' => auth()->id(),
                'origin_currency' => $transaction->getInvoice()->currencyOrigin(),
                'destination_currency' => $transaction->getInvoice()->currencyDestination(),
                'amount_in_cents' => $transaction->getInvoice()->amountInCents(),
                'payment_method' => $transaction->getInvoice()->paymentMethod()->value,
                'payment_fee' => $transaction->getFeePaymentMethod(),
                'conversion_fee' => $transaction->getFeeConversion(),
                'converted_amount' => $transaction->getPurchasedCurrencyDestination(),
                'value_of_used_currency' => $transaction->getAmountAfterApplyFees() / 100,
                'value_of_destination_currency' => $transaction->getRateConversion() / 100,
            ]
        );
    }
}
