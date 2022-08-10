<?php

namespace App\Services;

use Illuminate\Support\Arr;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Intl\Currencies;

class ExchangeCurrencyService
{
    private string $source;
    private string $target;
    private float $amount;
    private string $method;
    private ExchangeAPI $api;
    private array $payment_fee_array = ['billet' => 1.45, 'credit_card' => 7.63];

    public function __construct($request)
    {
        $this->source = $request->source ?? 'BRL';
        $this->target = $request->target;
        $this->amount = $request->amount;
        $this->method = $request->method;
        $this->api = new ExchangeAPI();
        return $this;
    }

    public function setSource($source): void
    {
        $this->source = $source;
    }

    public function setTarget($target): void
    {
        $this->target = $target;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @throws \Exception
     */
    public function validateExchange(): bool
    {
        if(!$this->target || !$this->amount || !$this->method) {
            throw new \Exception('Target, amount and method are required');
        }

        if($this->amount < 1000 OR $this->amount > 100000) {
            throw new \Exception('Amount must be between 1000 and 100000');
        }

        if(!in_array($this->method, array_keys($this->payment_fee_array))) {
            $message = "Method '{$this->method}' not found, method available: " . implode(' | ', array_keys($this->payment_fee_array));
            throw new \Exception($message);
        }

        return true;
    }

    public function getTaxes()
    {
        if($this->amount < 3000) {
            $exchange_fee = 2;
        } else {
            $exchange_fee = 1;
        }

        $payment_fee = $this->payment_fee_array[$this->method];

        return [
            'exchange' => round($this->amount * $exchange_fee / 100, 2),
            'payment' => round($this->amount * $payment_fee / 100, 2),
        ];
    }

    /**
     * @throws \Exception
     */
    public function exchange()
    {
        if(!$this->validateExchange()) {
            throw new \Exception('Invalid input data');
        }

        $current_bid = $this->api->getCurrentBid($this->source, $this->target);

        $fee_amount = $this->getTaxes();

        $amount_result = $this->amount - $fee_amount['payment'] - $fee_amount['exchange'];

        $response = collect([
            'source' => $this->source,
            'amount_result' => $amount_result,
            'amount_total' => round($amount_result * $current_bid, 2),
            'bid' => $current_bid,
            'fee' => $fee_amount,
        ]);


        return $response;

    }

    public function response()
    {
        $exchange_result = $this->exchange();

        return [
            'source_currency' => $this->source,
            'target_currency' => $this->target,
            'source_amount' => $this->amount,
            'method' => $this->method,

            'target_value' => $exchange_result->get('bid'),
            'payment_tax' =>  $exchange_result->get('fee')['payment'],
            'exchange_tax' => $exchange_result->get('fee')['exchange'],
            'target_amount' => $exchange_result->get('amount_result'),
            'target_total' => $exchange_result->get('amount_total'),

            'target_prefix' => Currencies::getSymbol($this->target),
            'source_prefix' => Currencies::getSymbol($exchange_result->get('source')),
        ];
    }
}
