<?php 
namespace App\Services;

use GuzzleHttp\Client;

class CurrencyConversionService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    //obtem taxa de conversão da moeda selecionada
    public function getConversionRate($currency)
    {
        $response = $this->client->get("https://economia.awesomeapi.com.br/json/last/{$currency}-BRL");
        $data = json_decode($response->getBody(), true);
        return $data["{$currency}BRL"]['bid'];
    }
    //calcula taxas
    public function calculateFees($amount, $payment_method)
    {
        $payment_fee = $payment_method === 'boleto' ? 1.45 : 7.63;
        $conversion_fee = $amount < 3000 ? 2 : 1;

        $payment_fee_amount = $amount * ($payment_fee / 100);
        $conversion_fee_amount = $amount * ($conversion_fee / 100);
        $net_amount = $amount - $payment_fee_amount - $conversion_fee_amount;

        return [
            'payment_fee_amount' => $payment_fee_amount,
            'conversion_fee_amount' => $conversion_fee_amount,
            'net_amount' => $net_amount,
        ];
    }
    //converte valores
    public function convert($conversion_rate, $fees)
    {
        return $fees['net_amount'] / $conversion_rate;
    }
}

