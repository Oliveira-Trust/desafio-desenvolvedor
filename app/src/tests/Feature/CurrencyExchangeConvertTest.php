<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CurrencyExchangeConvertTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCurrencyExchangeConvert()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('GET', '/currency-exchange/convert', [
            'originValue' => '2.000,00',
            'destinationCurrency' => 'USD',
            'paymentMethod' => 'creditCard'
        ]);

        $response->assertStatus(200);
    }
}
