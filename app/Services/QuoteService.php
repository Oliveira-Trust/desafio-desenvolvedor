<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BankInvoice;
use App\Models\ConversionRate;
use App\Models\CreditCard;
use App\Models\Money;
use App\Models\Payment;
use App\Models\Quotation;
use App\Repositories\QuoteRepository;
use AwesomeApi\Connection\HttpConnection;

class PaymentService
{
    private HttpConnection $httpConnection;
    private QuoteRepository $quoteRepository;

    public function __construct(HttpConnection $httpConnection, QuoteRepository $quoteRepository)
    {
        $this->httpConnection = $httpConnection;
        $this->quoteRepository = $quoteRepository;
    }

    public function quoteGenerate(array $attributes): array
    {
        $currency = $this->httpConnection->quoteCurrency($attributes);

        $money = new Money($attributes);
        $methodPayment = $this->getMethodPayment($attributes, $money);
        $conversionRate = new ConversionRate($money);

        $quote = (new Quotation($methodPayment, $money, $conversionRate, $currency))->generate()->toArray();
        $this->quoteRepository->save($quote);
        return $quote;
    }

    public function getMethodPayment(array $attributes, Money $money): Payment
    {
        $payment = data_get($attributes, 'payment');
        $payments = [
            CreditCard::NAME => new CreditCard($money),
            BankInvoice::NAME => new BankInvoice($money)
        ];

        if (array_key_exists(data_get($attributes, 'payment'), $payments)) {
            return $payments[$payment];
        }

        return $payment[BankInvoice::NAME];
    }
}
