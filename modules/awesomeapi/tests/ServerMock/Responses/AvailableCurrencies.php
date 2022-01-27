<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\ServerMock\Responses;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AvailableCurrencies extends BaseResponseMock
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getResponse(): PromiseInterface
    {
        return Http::response(
            $this->getJson('AvailableCurrencies'),
            Response::HTTP_OK
        );
    }
}
