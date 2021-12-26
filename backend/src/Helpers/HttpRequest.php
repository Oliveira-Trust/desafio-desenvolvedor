<?php
declare(strict_types=1);

namespace App\Helpers;

class HttpRequest 
{
    private $url;
    public function __construct(array $arr)
    {
        $this->url = $arr['url'];
    }
    public function search($params = 'all', $method = 'GET')
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url.$params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            ]);
            $response = curl_exec($curl);
            curl_close($curl);            
            return json_decode($response);
    }
}