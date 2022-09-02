<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Quotation
{

    private string $url;
    private string $combination;
    private string $source;
    private string $target;
    private float $bid;
    private array $available;
    private array $types;

    public function __construct(string $source = '', string $target = '', string $url = 'https://economia.awesomeapi.com.br')
    {
       $this->url = $url;
       $this->source = $source;
       $this->target = $target;
       $this->combination = $source . '-' . $target;
       $this->bid = 0;
       $this->available = array();
       $this->types = array();
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getBid(): float
    {
        if ($this->bid == 0) $this->makeBid();
        return $this->bid;
    }

    public function getTypes(): array
    {
        $this->makeTypes();
        return $this->types;
    }

    public function getAvailable(): array
    {
        return $this->available;
    }

    public function makeBid()
    {
        if(!$this->checkAvailable()) return null;
        $promise = Http::async()->get($this->url . '/json/last/' . $this->combination)->then(function ($response) {
            $this->bid = json_decode($response->body(), true)["{$this->source}{$this->target}"]['bid'];
        });
        $promise->wait();
    }

    private function makeAvailable()
    {
        $promise = Http::async()->get($this->url . '/json/available')->then(function ($response) {
            $this->available = json_decode($response->body(), true);
        });
        $promise->wait();
      }

    public function checkAvailable(): bool
    {
        $this->makeAvailable();
        return (!in_array($this->combination, array_keys($this->available))) ? false : true;
    }

    public function makeTypes()
    {
        $promise = Http::async()->get($this->url . '/json/available/uniq')->then(function ($response) {
            $this->types = json_decode($response->body(), true);
        });
        $promise->wait();
    }

}
