<?php

declare(strict_types=1);

namespace Integration\currencyQuotes\src;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\Log;
use Integration\CommonsPackages\Interfaces\ResponseInterface;
use Integration\CommonsPackages\Requests\Request as BaseRequest;

final class Request extends BaseRequest
{

    public function execute(): ResponseInterface
    {
        try {
            $response = parent::execute();
        } catch (TransferException | ClientException | ServerException $exception) {
            Log::debug('error_request_currentQuotes',[
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'trace' => $exception->getTrace()
            ]);

            throw $exception;
        }

        return $response;
    }
}
