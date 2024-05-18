<?php

namespace Tests\Traits;

use App\Repositories\Api\CurrencyConversionRepository;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Mockery;
use Mockery\MockInterface;

trait EconomiaAwesomeApiMock
{
    public function mockCurrencyConversionContractRepository(array $data): CurrencyConversionRepository|MockInterface
    {
        return Mockery::mock(CurrencyConversionRepository::class, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('convert')->andReturn($data);
        });
    }

    public function mockCurrencyConversionContractRepositoryException(array $data, int $status): CurrencyConversionRepository|MockInterface
    {
        return Mockery::mock(CurrencyConversionRepository::class, function (MockInterface $mock) use ($data, $status) {
            $response = new Response(
                new Psr7Response(body: json_encode($data), status: $status)
            );

            $mock->shouldReceive('convert')->andThrow(new RequestException($response));
        });
    }

    public function mockCurrencyConversionData(string $origin, string $target): array
    {
        $key = implode(array: [$origin, $target], separator: '');

        return [
            $key => [
                'code' => $origin,
                'codein' => $target,
                'name' => $origin . ' / ' . $target,
                'high' => fake()->randomFloat(4, 0, 1),
                'low' => fake()->randomFloat(4, 0, 1),
                'varBid' => fake()->randomFloat(4, -0.01, 0.01),
                'pctChange' => fake()->randomFloat(2, -5, 5),
                'bid' => fake()->randomFloat(4, 0.0001, 1),
                'ask' => fake()->randomFloat(4, 0.0001, 1),
                'timestamp' => fake()->unixTime,
                'create_date' => fake()->date('Y-m-d H:i:s'),
            ],
        ];
    }

    public function mockCurrencyNotFoundException(string $origin, string $target): array
    {
        return [
            'status' => 404,
            'code' => 'CoinNotExists',
            'message' => "moeda nao encontrada {$origin}-{$target}"
        ];
    }

    public function mockCurrencyException(string $origin, string $target): array
    {
        return [
            'status' => fake()->numberBetween(400, 500),
            'code' => fake()->word(),
            'message' => "moeda nao encontrada {$origin}-{$target}"
        ];
    }
}
