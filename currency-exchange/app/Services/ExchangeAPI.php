<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ExchangeAPI
{

  public function makeRequest(string $target, string $origin = 'BRL')
  {
    $response = Http::get(env('EXCHANGE_BASE_URL') . $target . '-' . $origin, []);

    if (!$response->ok()) {
      throw new Exception('Exchange error: ' . $response->body());
    }

    return $response->json();
  }
}
