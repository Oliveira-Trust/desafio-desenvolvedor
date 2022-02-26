<?php

namespace App\Services;

use App\Exceptions\ClientHTTPException;
use GuzzleHttp\Exception\ClientException;

class GuzzeleHTTPService
{

    /**
     * @var $url
     */
    private $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @return array
     */
    private function request(string $method, string $endpoint)
    {
        try {
            $client = new \GuzzleHttp\Client();
            
            $res = $client->request($method, $endpoint);

            return json_decode((string)$res->getBody(), true);
        
        } catch (ClientException $e) {
            throw new ClientHTTPException(trans('exception.failHTTPRequest'));
        }
    }

    /**
     * @param string $resource
     * @return array
     */
    public function get(string $resource)
    {
        return $this->request('GET', "{$this->url}/$resource");
    }
}