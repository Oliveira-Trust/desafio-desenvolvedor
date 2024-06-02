<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Currency\CurrencyServiceRepository;
use App\Services\Currency\CurrencyService;
use App\Services\Cache\CacheService;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class CurrencyServiceTest extends TestCase
{
    protected $currencyServiceRepository;
    protected $currencyService;

    public function setUp(): void
    {
        parent::setUp();

        // Simular a resposta que esperamos da API
        $mockResponse = [
            'USD-BRL' => 'Dólar Americano/Real Brasileiro',
            'USD-BRLT' => 'Dólar Americano/Real Brasileiro Turismo',
            'CAD-BRL' => 'Dólar Canadense/Real Brasileiro',
            'EUR-BRL' => 'Euro/Real Brasileiro',
            'GBP-BRL' => 'Libra Esterlina/Real Brasileiro',
        ];

        $mock = new MockHandler([
            new Response(200,[], json_encode($mockResponse)),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->currencyService = new CurrencyService($client);
        $cacheService = new CacheService();

        $this->currencyServiceRepository = new CurrencyServiceRepository($this->currencyService, $cacheService);
    }

    public function testGetAvailableCurrencies()
    {
        Cache::flush();

        $currencies = $this->currencyServiceRepository->getAvailableCurrencies();

        $this->assertIsArray($currencies);

        $expectedKeys = ['USD-BRL', 'USD-BRLT', 'CAD-BRL', 'EUR-BRL', 'GBP-BRL'];
        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $currencies['data']);
        }
    }
}
