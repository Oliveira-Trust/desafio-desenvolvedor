<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BankInvoice;
use App\Models\CreditCard;
use App\Models\Money;
use App\Models\Payment;
use AwesomeApi\Connection\HttpConnection;

class PaymentService
{
    private HttpConnection $httpConnection;

    public function __construct(HttpConnection $httpConnection)
    {
        $this->httpConnection = $httpConnection;
    }

    public function quoteGenerate(array $attributes)
    {
        $attributes['money'] = $this->adapterTemporary($attributes);
        $currency = $this->httpConnection->quoteCurrency(data_get($attributes, 'destination-currency'));

        $money = new Money(data_get($attributes, 'money'));
        $methodPayment = $this->getMethodPayment($attributes, $money);


    }

    public function getMethodPayment(array $attributes, Money $money): Payment
    {
        if (array_key_exists(CreditCard::NAME, $attributes)) {
            return new CreditCard($money);
        }
        return new BankInvoice($money);
    }

    private function adapterTemporary($attributes): float
    {
        $money = data_get($attributes, 'money');
        return (float) str_replace(',', '.', str_replace('.', '', $money));
    }
}
