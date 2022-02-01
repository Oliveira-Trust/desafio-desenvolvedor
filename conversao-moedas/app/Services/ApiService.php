<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    private $endPoint = 'https://economia.awesomeapi.com.br';

    public static function getAll()
    {
        $response = Http::get(self::$endPoint);
    }
}
