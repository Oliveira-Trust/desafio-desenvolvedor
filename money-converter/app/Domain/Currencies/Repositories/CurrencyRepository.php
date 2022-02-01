<?php

namespace Domain\Currencies\Repositories;

use Domain\Currencies\Repositories\Interfaces\CurrencyRepositoryInterface;
use Infra\AwesomeApi\AwesomeApiClient;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private AwesomeApiClient $awesomeApiClient;

    public function __construct(AwesomeApiClient $awesomeApiClient)
    {
        $this->awesomeApiClient = $awesomeApiClient;
    }

    public function getAllAvailables()
    {
        $request = $this->awesomeApiClient->request('GET', 'json/available/uniq');
        return json_decode($request->getBody(), true);
    }
}
