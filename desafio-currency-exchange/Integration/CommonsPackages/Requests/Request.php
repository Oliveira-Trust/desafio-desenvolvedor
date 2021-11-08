<?php

declare(strict_types=1);

namespace Integration\CommonsPackages\Requests;

use GuzzleHttp\Client;
use Integration\CommonsPackages\Interfaces\RequestInterface;
use Integration\CommonsPackages\Interfaces\ResponseInterface;
use Integration\CommonsPackages\Responses\Response;

class Request implements RequestInterface
{
    protected $client;
    protected $options;
    protected $url;
    protected $data;
    protected $type;
    protected $response;
    protected $integrator;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 1200,
            'read_timeout' => 1200
        ]);
        $this->options = ['headers' => []];
        $this->response = new Response();
    }

    public function get(string $url): RequestInterface
    {
        $this->type = 'get';
        $this->url = $url;
        return $this;
    }

    public function execute(): ResponseInterface
    {
        $type = $this->type;

        return $this->response->build($this->client->$type($this->url, $this->options));
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
