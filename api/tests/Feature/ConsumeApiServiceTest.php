<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\ConsumeApiService;
use App\Traits\TestHelper;
use Tests\TestCase;
use \Exception;

class ConsumeApiServiceTest extends TestCase
{
    use TestHelper;
    private object $consumeApiService;

    public function setUp(): void
    {
        parent::setUp();
        $this->consumeApiService = new ConsumeApiService();
    }


    public function provideCurrenciesData(): array
    {
        return [
            'USD-BRL' => [
                ['USD', 'BRL'],
                true
            ],
            'EUR-BRL' => [
                ['EUR', 'BRL'],
                true
            ],
            'BTC-BRL' => [
                ['BTC', 'BRL'],
                true
            ],
            'BRL-BTC' => [
                ['BRL', 'BTC'],
                false
            ]
        ];
    }

    /**
     * @dataProvider provideCurrenciesData
     */
    public function testShouldAcceptOnlyValidExchanges(array $currencies, bool $expectedResult): void
    {
        $result = true;
        $getExchange = $this->getPrivateMethod(ConsumeApiService::class, 'getExchange');
        $response = $getExchange->invokeArgs($this->consumeApiService, array($currencies[0], $currencies[1]));

        if (isset($response['status']) && $response['status'] === ConsumeApiService::NOT_FOUND_HTTP_STATUS_CODE) {
            $result = false;
        }
        
        $this->assertSame($expectedResult, $result);
    }
}
