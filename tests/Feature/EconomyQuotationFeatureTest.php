<?php

declare(strict_types=1);

namespace Tests\Feature;

use AllowDynamicProperties;
use App\Connections\Clients\Economy\Routes;
use App\Enumerators\Exceptions;
use App\Facades\Helpers;
use App\Mail\ConversionMail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * @property $userToken
 */
#[AllowDynamicProperties] class EconomyQuotationFeatureTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userToken = Helpers::generateToken(User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . $this->userToken;

        Http::fake([
            Routes::CURRENCY_TRANSLATIONS => Http::response(self::economyQuotationAPIMock('translations'), Response::HTTP_OK),
            Routes::COMBINATIONS => Http::response(self::economyQuotationAPIMock('combinations'), Response::HTTP_OK),
            Routes::QUOTATION . 'BRL-USD' => Http::response(self::economyQuotationAPIMock('quotation'), Response::HTTP_OK),
        ]);
    }

    public function test_should_return_translations(): void
    {
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->userToken,
        ])->get('api/translations')
            ->assertJson([
                'AED' => 'Dirham dos Emirados',
                'BBD' => 'Dólar de Barbados',
                'ARS' => 'Peso Argentino'
            ])->assertOk();
    }

    public function test_should_return_combinations(): void
    {
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->userToken,
        ])->get('api/combinations')
            ->assertJson(self::economyQuotationAPIMock('combinations'))
            ->assertOk();
    }

    public function test_should_return_conversion(): void
    {
        Mail::fake();

        Payment::factory()->create([
            'slug' => "bank-slip",
            'rate' => 1.45
        ]);

        $this->post('api/conversion', [
            "from" => "BRL",
            "to" => "USD",
            "payment" => "bank-slip",
            "amount" => 5000
        ])->assertJson([
                'origin_currency' => 'BRL',
                'destiny_currency' => 'USD',
                'conversion_amount' => 5000,
                'payment_type' => 'Boleto',
                'payment_rate' => 72.5,
                'amount_destination_currency' => 5.443658138268916,
                'amount_currency_purchased' => 918.5,
                'conversion_rate' => 50,
                'amount_used_conversion' => 4877.5
            ])->assertOk();

        Mail::assertSent(ConversionMail::class, 1);
    }

    private static function economyQuotationAPIMock(string $uri): array
    {
        return[
            'translations' => [
                  'AED' => 'Dirham dos Emirados',
                  'AFN' => 'Afghani do Afeganistão',
                  'ALL' => 'Lek Albanês',
                  'AMD' => 'Dram Armênio',
                  'ANG' => 'Guilder das Antilhas',
                  'AOA' => 'Kwanza Angolano',
                  'ARS' => 'Peso Argentino',
                  'AUD' => 'Dólar Australiano',
                  'AZN' => 'Manat Azeri',
                  'BAM' => 'Marco Conversível',
                  'BBD' => 'Dólar de Barbados',
                  'BDT' => 'Taka de Bangladesh',
                  'BGN' => 'Lev Búlgaro',
                  'BHD' => 'Dinar do Bahrein',
                  'BIF' => 'Franco Burundinense',
                  'BND' => 'Dólar de Brunei',
                  'BOB' => 'Boliviano',
                  'BRL' => 'Real Brasileiro'
            ],
            'combinations' => [
                'BRL-USD' => 'Real Brasileiro/Dólar Americano',
                'BRL-AED' => 'Real Brasileiro/Dólar Americano',
                'BRL-ARS' => 'Real Brasileiro/Dólar Americano',
                'BRL-BBD' => 'Real Brasileiro/Dólar Americano',
                'BRL-EUR' => 'Real Brasileiro/Euro',
                'USD-EUR' => 'Dólar Americano/Euro',
                'CAD-EUR' => 'Dólar Canadense/Euro',
                'GBP-EUR' => 'Libra Esterlina/Euro',
                'ARS-EUR' => 'Peso Argentino/Euro',
                'JPY-EUR' => 'Iene Japonês/Euro',
                'CHF-EUR' => 'Franco Suíço/Euro',
                'AUD-EUR' => 'Dólar Australiano/Euro',
                'CNY-EUR' => 'Yuan Chinês/Euro',
                'ILS-EUR' => 'Novo Shekel Israelense/Euro',
                'BTC-EUR' => 'Bitcoin/Euro',
                'LTC-EUR' => 'Litecoin/Euro',
                'ETH-EUR' => 'Ethereum/Euro',
                'XRP-EUR' => 'XRP/Euro',
            ],
            'quotation' => [
                'BRLUSD' => [
                    'code' => 'BRL',
                    'codein' => 'USD',
                    'name' => 'Real Brasileiro/Dólar Americano',
                    'high' => '0.1861',
                    'low' => '0.1834',
                    'varBid' => '-0.0009',
                    'pctChange' => '-0.49',
                    'bid' => '0.1837',
                    'ask' => '0.1838',
                    'timestamp' => '1720721116',
                    'create_date' => '2024-07-11 15:05:16'
                ]
            ],
        ][$uri] ?? [];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($_SERVER['HTTP_AUTHORIZATION']);
    }
}
