<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Domain\Contracts\Http\HttpRequestInterface;

class HttpRequest implements HttpRequestInterface
{
    protected $url;
    public function __construct(array $arr)
    {
        $this->url = $arr['url'];
    }
    public function request($params = '', $method = 'GET')
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $this->url.$params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public function setUrlRequest(string $url)
    {
        $this->url = $url;
    }
}