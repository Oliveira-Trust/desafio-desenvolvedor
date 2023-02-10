<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://economia.awesomeapi.com.br/json/last';
    }

    public function getCotacoes(Request $request): \Illuminate\Http\Client\Response
    {
       $url = "$this->baseUrl/$request->codigo";
       return Http::get($url);
    }
}
