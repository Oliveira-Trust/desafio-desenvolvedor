<?php

namespace Domain\Currencies\Actions;

use Domain\Currencies\Repositories\CurrencyRepository;

final class MapAvailablesCurrencies
{
    private CurrencyRepository $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function __invoke(): array
    {
        $allAvailables = $this->currencyRepository->getAllAvailables();
        $currenciesCode = array_keys($allAvailables);

        return array_map(function ($currencyCode) use ($allAvailables) {
            return [
                'code' => $currencyCode,
                'display_name' => $allAvailables[$currencyCode],
            ];
        }, $currenciesCode);
    }
}
