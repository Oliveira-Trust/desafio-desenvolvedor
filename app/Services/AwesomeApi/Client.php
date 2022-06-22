<?php

namespace App\Services\AwesomeApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use App\Services\AwesomeApi\Exceptions\AwesomeSDKException;

abstract class Client
{
    /**
     * @var GuzzleClient
     */
    private GuzzleClient $awesomeClient;

    /**
     * Timeout of the request in seconds.
     *
     * @var int
     */
    protected $timeOut = 30;

    /**
     * Connection timeout of the request in seconds.
     *
     * @var int
     */
    protected $connectTimeOut = 20;

    /**
     * Client constructor.
     *
     */
    public function __construct(GuzzleClient $awesomeClient)
    {
        $this->awesomeClient = $awesomeClient;
    }

    /**
     * Prepares and returns request options.
     *
     * @param array $headers
     * @param       $body
     * @param       $options
     * @param       $timeOut
     * @param bool $isAsyncRequest
     * @param int $connectTimeOut
     *
     * @return array
     */
    private function getOptions(array $headers, $body, $options, $timeOut, bool $isAsyncRequest = false, int $connectTimeOut = 10)
    {
        $default_options = [
            RequestOptions::HEADERS         => $headers,
            RequestOptions::BODY            => $body,
            RequestOptions::TIMEOUT         => $timeOut,
            RequestOptions::CONNECT_TIMEOUT => $connectTimeOut,
            RequestOptions::SYNCHRONOUS     => !$isAsyncRequest,
        ];

        return array_merge($default_options, $options);
    }

    /**
     * @param $url
     * @param $method
     * @param array $headers
     * @param array $options
     * @param int $timeOut
     * @param bool $isAsyncRequest
     * @param int $connectTimeOut
     * @return ResponseInterface
     * @throws AwesomeSDKException
     */
    public function send(
        $url,
        $method,
        array $headers = [],
        array $options = [],
        int $timeOut = 30,
        bool $isAsyncRequest = false,
        int $connectTimeOut = 20
    ) {
        $this->timeOut = $timeOut;
        $this->connectTimeOut = $connectTimeOut;

        $body = isset($options['body']) ? $options['body'] : null;
        $options = $this->getOptions($headers, $body, $options, $timeOut, $isAsyncRequest, $connectTimeOut);

        try {
            $response = $this->getClient()->requestAsync($method, $url, $options);

            if ($isAsyncRequest) {
                self::$promises[] = $response;
            } else {
                $response = $response->wait();
            }
        } catch (RequestException $e) {
            $response = $e->getResponse();

            if (!$response instanceof ResponseInterface) {
                throw new AwesomeSDKException($e->getMessage(), $e->getCode());
            }
        }

        return $response;
    }

    /**
     * @return StripeClient|GuzzleClient
     */
    protected function getClient()
    {
        return $this->awesomeClient;
    }

    /**
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @return int
     */
    public function getConnectTimeOut()
    {
        return $this->connectTimeOut;
    }
}
