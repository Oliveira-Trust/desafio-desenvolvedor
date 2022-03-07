<?php

namespace App\Services;

use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyService
{
    private $currencyRepositoryInterface;

    public function __construct(CurrencyRepositoryInterface $currencyRepositoryInterface)
    {
        $this->currencyRepositoryInterface = $currencyRepositoryInterface;
    }

    public function store(array $data)
    {
        $this->currencyRepositoryInterface->store($data);
    }
}
