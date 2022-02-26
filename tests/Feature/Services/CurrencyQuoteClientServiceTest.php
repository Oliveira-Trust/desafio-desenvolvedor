<?php

namespace Tests\Feature\Services;

use App\Services\CurrencyQuoteClientService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Tests\TestCase;

class CurrencyQuoteClientServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnLastAsk()
    {
        $client = Mockery::mock(Client::class);
        app()->instance(Client::class, $client);

        $client->shouldReceive('request')
            ->with('GET', 'https://economia.awesomeapi.com.br/last/BRL-USD', Mockery::any())
            ->andReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        "BRLUSD" =>  [
                            "code" => "BRL",
                            "codein" => "USD",
                            "name" => "Real Brasileiro/Dólar Americano",
                            "high" => "0.1968",
                            "low" => "0.193",
                            "varBid" => "-0.0015",
                            "pctChange" => "-0.75",
                            "bid" => "0.1937",
                            "ask" => "0.1937",
                            "timestamp" => "1645824539",
                            "create_date" => "2022-02-25 18:28:59",
                        ]
                    ]
                )
            ));

        $currencyQuoteClientService = new CurrencyQuoteClientService(new Client());

        $lastQuota = $currencyQuoteClientService->getLastAks('BRL', 'USD');

        $this->assertEquals(0.1937, $lastQuota);
    }
}
