<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\ServerMock;

use AwesomeApi\Connection\AwesomeRoutes;
use AwesomeApi\Tests\ServerMock\Responses\AuthenticateMock;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AwesomeApiMock
{
    private const ROUTES = [
        AwesomeRoutes::FIRST_ROUTE => AuthenticateMock::class
    ];

    public function handle(Request $request): PromiseInterface
    {
        $route = str_replace($this->getBasePath(), "", $request->url());

        if (array_key_exists($route, self::ROUTES) === false) {
            return Http::response(
                ['data' => 'Response not found'], Response::HTTP_NOT_FOUND
            );
        }

        $responseClass = self::ROUTES[$route];
        return (new $responseClass($request))->getResponse();
    }

    private function getBasePath(): string
    {
        return config('awesomeapi.basePath', '');
    }
}
