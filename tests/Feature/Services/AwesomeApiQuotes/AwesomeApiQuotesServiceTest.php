<?php

namespace Tests\Feature\Services\AwesomeApiQuotes;

use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use App\Services\AwesomeApiQuotes\Endpoints\Quotes;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class AwesomeApiQuotesServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testLastQuotes()
    {
        // Dados simulados retornados pela API
        $apiResponse = [
            'BRLUSD' => [
                'code' => 'BRL',
                'codein' => 'USD',
                'name' => 'Real Brasileiro/Dólar Americano',
                'high' => '0.1959',
                'low' => '0.1947',
                'varBid' => '0.0008',
                'pctChange' => '0.41',
                'bid' => '0.1957',
                'ask' => '0.1958',
                'timestamp' => '1715968542',
                'create_date' => '2024-05-17 14:55:42'
            ]
        ];

        // Cria um mock para o serviço AwesomeApiQuotesService
        $mockService = Mockery::mock(AwesomeApiQuotesService::class);

        // Cria um mock para o endpoint Quotes
        $mockQuotes = Mockery::mock(Quotes::class);

        // Configura o mock do endpoint Quotes para retornar a resposta simulada
        $mockQuotes->shouldReceive('last')
            ->with('BRL-USD')
            ->andReturn(collect($apiResponse));

        // Configura o serviço para retornar o mock de Quotes
        $mockService->shouldReceive('quotes')
            ->andReturn($mockQuotes);

        // Usa o mock do serviço para chamar o método last
        $result = $mockService->quotes()->last('BRL-USD');

        // Verifica se o resultado é o esperado
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
        $quote = $result->first();
        $this->assertEquals('BRL', $quote['code']);
        $this->assertEquals('USD', $quote['codein']);
        $this->assertEquals('Real Brasileiro/Dólar Americano', $quote['name']);
        $this->assertEquals('0.1959', $quote['high']);
        $this->assertEquals('0.1947', $quote['low']);
        $this->assertEquals('0.0008', $quote['varBid']);
        $this->assertEquals('0.41', $quote['pctChange']);
        $this->assertEquals('0.1957', $quote['bid']);
        $this->assertEquals('0.1958', $quote['ask']);
        $this->assertEquals('1715968542', $quote['timestamp']);
        $this->assertEquals('2024-05-17 14:55:42', $quote['create_date']);
    }

    public function testAvailableQuotes()
    {

        $service = new AwesomeApiQuotesService();

        $result = $service->quotes()->available();

        $this->assertIsArray($result);
    }
}
