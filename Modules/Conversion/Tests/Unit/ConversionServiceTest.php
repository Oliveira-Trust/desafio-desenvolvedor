<?php

namespace Modules\Conversion\Tests\Unit;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Mockery\MockInterface;
use Modules\Conversion\Drivers\CurrencyExchangeAwesomeapi;
use Modules\Conversion\Exceptions\ConversionException;
use Modules\Conversion\Interfaces\CurrencyExchangeInterface;
use Modules\Conversion\Models\Conversion;
use Modules\Conversion\Notifications\ConversionNotification;
use Modules\Conversion\Services\ConversionService;
use Tests\TestCase;

class ConversionServiceTest extends TestCase {

    use DatabaseTransactions;

    private User $user;
    private ConversionService $conversionService;

    protected function setUp(): void {
        parent::setUp();
        $this->user = UserFactory::new()->create();

        $this->actingAs($this->user);

        $this->instance(
            CurrencyExchangeInterface::class,
            Mockery::mock(CurrencyExchangeAwesomeapi::class, function (MockInterface $mock) {
                $mock->shouldReceive('get')->andReturn(5.30);
            })
        );

        $this->conversionService = new ConversionService();
        Notification::fake();
        Notification::assertNothingSent();
    }

    public function testConversionBilletGreaterThan3000(): void {
        $this->assertDatabaseEmpty(Conversion::class);

        $this->conversionService->create('BRL', 'USD', 500000, 1);

        $this->assertDatabaseCount(Conversion::class, 1);

        $this->assertDatabaseHas(Conversion::class, [
            "currency_origin_name"           => "BRL",
            "currency_origin_symbol"         => "R$",
            "currency_destiny_name"          => "USD",
            "currency_destiny_symbol"        => "$",
            "payment_type"                   => "Boleto",
            "currency_origin_value"          => 500000,
            "currency_origin_value_with_tax" => 487750,
            "currency_destiny_value"         => 92028,
            'payment_tax'                    => 7250,
            "conversion_tax"                 => 5000,
            "currency_destiny_conversion"    => 530
        ]);

        Notification::assertSentTo(
            [$this->user], ConversionNotification::class
        );
    }

    public function testConversionBilletSmallerThan3000(): void {
        $this->assertDatabaseEmpty(Conversion::class);

        $this->conversionService->create('BRL', 'USD', 200000, 1);

        $this->assertDatabaseCount(Conversion::class, 1);

        $this->assertDatabaseHas(Conversion::class, [
            "currency_origin_name"           => "BRL",
            "currency_origin_symbol"         => "R$",
            "currency_destiny_name"          => "USD",
            "currency_destiny_symbol"        => "$",
            "payment_type"                   => "Boleto",
            "currency_origin_value"          => 200000,
            "currency_origin_value_with_tax" => 193100,
            "currency_destiny_value"         => 36433,
            'payment_tax'                    => 2900,
            "conversion_tax"                 => 4000,
            "currency_destiny_conversion"    => 530
        ]);

        Notification::assertSentTo(
            [$this->user], ConversionNotification::class
        );
    }

    public function testConversionCardSmallerThan3000(): void {
        $this->assertDatabaseEmpty(Conversion::class);

        $this->conversionService->create('BRL', 'USD', 200000, 2);

        $this->assertDatabaseCount(Conversion::class, 1);

        $this->assertDatabaseHas(Conversion::class, [
            "currency_origin_name"           => "BRL",
            "currency_origin_symbol"         => "R$",
            "currency_destiny_name"          => "USD",
            "currency_destiny_symbol"        => "$",
            "payment_type"                   => "Cartão de Crédito",
            "currency_origin_value"          => 200000,
            "currency_origin_value_with_tax" => 180740,
            "currency_destiny_value"         => 34101,
            'payment_tax'                    => 15260,
            "conversion_tax"                 => 4000,
            "currency_destiny_conversion"    => 530
        ]);

        Notification::assertSentTo(
            [$this->user], ConversionNotification::class
        );
    }

    public function testConversionCardGreaterThan5000(): void {
        $this->assertDatabaseEmpty(Conversion::class);

        $this->conversionService->create('BRL', 'USD', 500000, 2);

        $this->assertDatabaseCount(Conversion::class, 1);

        $this->assertDatabaseHas(Conversion::class, [
            "currency_origin_name"           => "BRL",
            "currency_origin_symbol"         => "R$",
            "currency_destiny_name"          => "USD",
            "currency_destiny_symbol"        => "$",
            "payment_type"                   => "Cartão de Crédito",
            "currency_origin_value"          => 500000,
            "currency_origin_value_with_tax" => 456850,
            "currency_destiny_value"         => 86198,
            'payment_tax'                    => 38150,
            "conversion_tax"                 => 5000,
            "currency_destiny_conversion"    => 530
        ]);

        Notification::assertSentTo(
            [$this->user], ConversionNotification::class
        );
    }

    public function testConversionApiFailed(): void {
        $this->instance(
            CurrencyExchangeInterface::class,
            Mockery::mock(CurrencyExchangeAwesomeapi::class, function (MockInterface $mock) {
                $mock->shouldReceive('get')->once()->andReturnNull();
            })
        );

        $this->assertDatabaseEmpty(Conversion::class);

        $this->expectException(ConversionException::class);
        $this->conversionService->create('BRL', 'USD', 500000, 2);

        $this->assertDatabaseEmpty(Conversion::class);

        Notification::assertNothingSent();
    }
}
