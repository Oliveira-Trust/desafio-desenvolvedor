<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\StatusType;
use App\Models\Currency;
use App\Services\CurrencyService;
use Tests\TestCase;

class CurrencyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->currencyService = app(CurrencyService::class);
    }

    public function test_get_currencies(): void
    {
        $currency = Currency::factory(2)->create();
        $result = $this->currencyService->getAllCurrencies();

        $this->assertCount(2, $result);
    }

    public function test_not_find_activated_currency(): void
    {
        $params = [
            "name" => "Play Station",
            "code" => 'PSN',
            "status" => StatusType::INACTIVATED,
        ];
        $this->currencyService->storeCurrency($params);
        $result = $this->currencyService->getAllActiveCurrencies();

        $this->assertCount(0, $result);
    }

    public function test_find_currency_by_id(): void
    {
        $params = [
            "name" => "Play Station",
            "code" => 'PSN',
            "status" => StatusType::ACTIVATED,
        ];
        $currency = $this->currencyService->storeCurrency($params);
        $result = $this->currencyService->getCurrencyById($currency->id);

        $this->assertEquals('Play Station', $result->name);
    }

    public function test_store_currency(): void
    {
        $params = [
            "name" => "Play Station",
            "code" => 'PSN',
            "status" => StatusType::ACTIVATED,
        ];
        $currency = $this->currencyService->storeCurrency($params);
        $result = $this->currencyService->getCurrencyById($currency->id);

        $this->assertEquals('Play Station', $result->name);
    }

    public function test_update_currency(): void
    {
        $currency = Currency::factory()->create();

        $params = [
            "name" => "Play Station",
            "code" => 'PSN',
            "status" => StatusType::ACTIVATED,
        ];
        $this->currencyService->updateCurrency($currency->id, $params);
        $result = $this->currencyService->getCurrencyById($currency->id);

        $this->assertEquals('Play Station', $result->name);
    }
}
