<?php

namespace Oliveiratrust\CurrencyPrice;

use Http;
use Illuminate\Console\Command;
use Oliveiratrust\Currency\CurrencyRepository;
use Oliveiratrust\CurrencyPrice\API\CurrencyPricewesomeAPI;
use Oliveiratrust\Models\Currency\Currency;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;

class CurrencyPriceRefreshFromAPIService {

    public function __construct(
        private CurrencyPrice          $model,
        private CurrencyRepository     $repository,
        private CurrencyPricewesomeAPI $api
    )
    {
    }

    public function call(Command $command = null, int $currency_id = null)
    {
        $currencies = $this->repository->getActivesCurrencies($currency_id);

        foreach ($currencies as $currency) {
            $command->info('Starting refresh price: ' . $currency->code);

            $newPrice = $this->refreshPrice($currency);

            $command->info('[OK] ' . $currency->code . ' new price: R$' . $newPrice->price);
            $command->info('================================');
        }
    }

    private function refreshPrice(Currency $currency): CurrencyPrice
    {
        $price = $this->api->call($currency);

        return $this->model->create([
            'currency_id' => $currency->id,
            'price'       => $price
        ]);
    }
}
