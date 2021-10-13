<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusType;
use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyService
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getAllCurrencies() : array
    {
        return $this->currencyRepository->getAll()->toArray();
    }

    public function getAllActiveCurrencies() : array
    {
        return $this->currencyRepository->findWhere('status', StatusType::ACTIVATED)
                                        ->toArray();
    }

    public function getCurrencyObj(int $id): Currency
    {
        $result = $this->currencyRepository->findById($id);

        return Currency::createFromEloquent($result);
    }

    public function getCurrencyById(int $id): Currency
    {
        return $this->currencyRepository->findById($id);
    }

    public function storeCurrency(array $request) : Currency
    {
        return $this->currencyRepository->store($request);
    }

    public function updateCurrency(int $id, array $request) : bool
    {
        return $this->currencyRepository->update($id, $request);
    }
}
