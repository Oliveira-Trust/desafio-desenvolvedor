<?php

declare(strict_types=1);

namespace Integration\CommonsPackages\Responses;

use Integration\CommonsPackages\Interfaces\ResponseInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterfaceBase;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class Response implements ResponseInterface
{
    protected $httpCode = ResponseCodes::HTTP_OK;
    protected $data;
    protected $additionalInfo;
    protected $requestUrl;
    protected $requestData;

    public function __construct($data = [], array $additionalInfo = [])
    {
        $this->data = $data;
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @return mixed[]
     */
    public function generateResponse(): array
    {
        $response = data_get($this->data, 'data');

        foreach ($this->additionalInfo as $key => $info) {
            $response[$key] = $info;
        }

        return $response;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @return mixed[]
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    public function build(ResponseInterfaceBase $response): ResponseInterface
    {
        $this->httpCode = $response->getStatusCode();
        if (str_contains($response->getHeaderLine('content-type'), 'text/html')) {
            $this->data = (string)$response->getBody();
            return $this;
        }

        $this->data = (array)json_decode($response->getBody()->__toString(), true);
        return $this;
    }
}
