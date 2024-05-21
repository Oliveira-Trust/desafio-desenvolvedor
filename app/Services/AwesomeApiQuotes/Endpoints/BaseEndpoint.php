<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;

use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use App\Services\AwesomeApiQuotes\Entities\QuoteEntity;
use Illuminate\Support\Collection;

class BaseEndpoint
{
    protected AwesomeApiQuotesService $service;

    public function __construct()
    {
        $this->service = new AwesomeApiQuotesService();
    }

    protected function transform(mixed $json, string $entity): Collection
    {
        return collect($json)
            ->map(fn ($data) => $entity::fromArray($data));
    }
}
