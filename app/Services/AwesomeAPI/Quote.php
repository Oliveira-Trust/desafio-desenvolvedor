<?php

namespace App\Services\AwesomeAPI;

use Illuminate\Support\Facades\Http;

class Quote
{
    public function __construct(
        public string $origin,
        public string $destination
    ) {}

    public function handle(): float
    {
        return $this->response();
    }

    private function response() : float
    {
        $respose = Http::get("https://economia.awesomeapi.com.br/json/last/{$this->origin}-{$this->destination}")
            ->json();

        return $respose["{$this->origin}{$this->destination}"]['bid'];
    }
}
