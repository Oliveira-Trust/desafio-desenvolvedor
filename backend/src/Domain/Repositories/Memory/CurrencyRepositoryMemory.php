<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Memory;

use App\Domain\Contracts\Repository\CurrencyRepositoryInterface;
use App\Domain\Entities\Currency;

class CurrencyRepositoryMemory implements CurrencyRepositoryInterface
{
    private $currencies;
    public function __construct()
    {
        $this->currencies = [];
    }
    public function getById(int $id):? Currency
    {
        foreach($this->currencies as $key => $currency) {
            if($key == $id) {
                return $currency;
            }
        }
        return null;
    }
    public function getAll(): array
    {
        return $this->currencies;
    }
    public function getByCurrencyCode(string $code):? Currency
    {
        foreach($this->currencies as $currency) {
            $currencyCode = $currency->getCode() . '-' . $currency->getCodein();
            if($currencyCode == $code) {
                return $currency;
            }
        }
        return null;
    }
    public function save(Currency $currency): Currency
    {
        $key = count($this->currencies) +1;
        $this->currencies[$key] = $currency;
        return $currency;
    }
}