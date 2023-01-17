<?php

namespace App\Domains\Exchange\Libraries;

use App\Domains\Exchange\Interfaces\IExchangeConvert;
use App\Domains\Exchange\DTO\ConversionResultDTO;
use App\Domains\Exchange\Models\ExchangeApisCurrencies;
use Illuminate\Support\Facades\Http;


class AwesomeAPI implements IExchangeConvert
{
    protected $client;

    public function __construct(public string $base_uri, public string $slug)
    {
    }

    public function currencyExchange(int $currency_id_from, int $currency_id_to, string $amount_net): ConversionResultDTO
    {
        $currency_from = ExchangeApisCurrencies::findCurrencyBySlug($currency_id_from, $this->slug);

        $currency_to = ExchangeApisCurrencies::findCurrencyBySlug($currency_id_to, $this->slug);

        $url = "{$this->base_uri}json/last/{$currency_to->code}-{$currency_from->code}";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get($url);

        if(!$response->successful()){
            throw new \Exception("Api de cotação indisponível");
        }

        $data = json_decode($response->body(), true);

        $amount_bid = $data["{$currency_to->code}{$currency_from->code}"]["bid"];
        $amount_convert_to = bcdiv($amount_net, $amount_bid);

        return new ConversionResultDTO($amount_bid, $amount_convert_to);
    }
}
