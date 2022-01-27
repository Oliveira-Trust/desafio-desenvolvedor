<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\ServerMock;

use AwesomeApi\Connection\AwesomeRoutes;
use AwesomeApi\Tests\ServerMock\Responses\AvailableCurrencies;
use AwesomeApi\Tests\ServerMock\Responses\QuoteCurrencyMock;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AwesomeApiMock
{
    private const ROUTES = [
        AwesomeRoutes::AVAILABLE_CURRENCIES => AvailableCurrencies::class,
        AwesomeRoutes::QUOTE_CURRENCY => QuoteCurrencyMock::class
    ];

    private ?string $route;

    public function handle(Request $request): PromiseInterface
    {
        $this->checkIfRouteNotExists(
            array_keys(self::ROUTES),
            str_replace($this->getBasePath(), "", $request->url())
        );

        if (is_null($this->route)) {
            return Http::response(
                ['data' => 'Response not found'], Response::HTTP_NOT_FOUND
            );
        }

        $responseClass = self::ROUTES[$this->route];
        return (new $responseClass($request))->getResponse();
    }

    private function checkIfRouteNotExists(array $keysRoutes, $routeOfRequest): void
    {
        foreach($keysRoutes as $key) {
            if (str_contains($routeOfRequest, $key)) {
                $this->route = $key;
                return;
            };
        }
        $this->route = null;
    }

    private function getBasePath(): string
    {
        return config('awesomeapi.basePath');
    }
}
