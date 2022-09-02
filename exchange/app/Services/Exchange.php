<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

use App\Services\Strategies\Fee;
use App\Services\Strategies\FeeStrategy;
use App\Services\Order;
use Symfony\Component\Intl\Currencies;

class Exchange
{

    private string $source;
    private string $target;
    private float $amount;
    private string $url;
    private Order $order;


    public function __construct(Order $order, string $token = '', string $url = 'http://nginx-quotation:82/api')
    {
       $this->url = $url;
       $this->order = $order;
       $this->source = $order->getSource();
       $this->target = $order->gettarget();
       $this->token = $token;
       $this->combination = $this->source . '/' . $this->target;
    }

    public function setTargetAmount()
    {
        $this->order->setTargetAmount($this->order->getAmount() - $this->order->getPaymentFee() - $this->order->getExchangeFee());
    }

    public function setTargetValue()
    {
        $promise = Http::async()->get($this->url . '/' . $this->combination)->then(function ($response) {
            $bid = json_decode($response->body(), true);
            if($bid) $this->order->setTargetValue($bid[0]);
        });
        $promise->wait();
    }

    public function setTargetTotal()
    {
        $this->order->setTargetTotal(round($this->order->getTargetAmount() * $this->order->getTargetValue(), 2));
    }

    public function setSymbols()
    {
        $this->order->setTargetPrefix(Currencies::getSymbol($this->target));
        $this->order->setSourcePrefix(Currencies::getSymbol($this->source));
    }

    public function setToken()
    {
        $this->order->setToken($this->token);    
    }

    public function calculete()
    {
        $strategy = new FeeStrategy();
        $fee = new Fee($strategy($this->order));
        $fee->calculate($this->order);
        $this->setTargetValue();
        $this->setTargetAmount();
        $this->setTargetTotal();
        $this->setSymbols();
        if($this->token) $this->setToken();
    }

}
