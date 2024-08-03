<?php

namespace Tests\Unit;

use App\Http\Controllers\CurrencyConverterController;
use App\Models\Conversion;
use App\Services\CurrencyConverterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;


class CurrencyConverterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndex()
    {
        $conversion = Conversion::factory()->create();
        $controller = new CurrencyConverterController(Mockery::mock(CurrencyConverterService::class));

        $response = $controller->index(new Request());

        $this->assertEquals('dashboard', $response->getName());
        $this->assertArrayHasKey('conversions', $response->getData());
        $this->assertTrue($response->getData()['conversions']->contains($conversion));
    }

    public function testShow()
    {
        $conversion = Conversion::factory()->create();
        $controller = new CurrencyConverterController(Mockery::mock(CurrencyConverterService::class));

        $response = $controller->show($conversion->id);

        $this->assertEquals('conversion.show', $response->getName());
        $this->assertArrayHasKey('conversion', $response->getData());
        $this->assertEquals($conversion->id, $response->getData()['conversion']->id);
    }

    public function testConvert()
    {
        $mockService = Mockery::mock(CurrencyConverterService::class);
        $mockService->shouldReceive('convertService')
            ->once()
            ->with('BRL', 'USD', 1000.0, 'credit_card')
            ->andReturn([
                'from' => 'BRL',
                'to' => 'USD',
                'amount' => 1096.3,
                'payment_method' => 'credit_card',
                'currency_value' => 5,
                'purchase_amount' => 219.26,
                'conversion_rate' => 20,
                'payment_rate' => 76.3,
                'purchase_price_excluding_taxes' => 1000
            ]);

        $controller = new CurrencyConverterController($mockService);

        $request = Request::create('/convert', 'POST', [
            'from' => 'BRL',
            'to' => 'USD',
            'amount' => 1000,
            'payment_method' => 'credit_card'
        ]);

        Auth::shouldReceive('user')
            ->once()
            ->andReturn((object) ['email' => 'test@example.com']);

        DB::shouldReceive('commit')
            ->once();

        $response = $controller->convert($request);

        $this->assertEquals(302, $response->status());
        $this->assertEquals(route('conversion.show', ['id' => Conversion::first()->id]), $response->getTargetUrl());
    }

    public function testDelete()
    {
        $conversion = Conversion::factory()->create();
        $controller = new CurrencyConverterController(Mockery::mock(CurrencyConverterService::class));

        $response = $controller->delete($conversion->id);

        $this->assertEquals(302, $response->status());
        $this->assertEquals(route('dashboard'), $response->getTargetUrl());
        $this->assertNull(Conversion::find($conversion->id));
    }
}
