<?php

namespace App\Actions;

use App\Models\Coin;
use App\Models\CoinPrice;
use App\Services\EconomiaApi;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ConsultaMoedasRegistradasAction
{
    private EloquentCollection $coins;

    public function execute(): void
    {
        $this->coins = Coin::all();
        $coinCombinations = $this->makeCoinPricesCombinations();

        $economiaApi = new EconomiaApi();
        $coinPrices = $economiaApi->last($coinCombinations);

        $this->upsertCoinPrices($coinPrices);
    }

    private function makeCoinPricesCombinations(): array
    {
        $coinCombinations = collect();
        $this->coins->each(function (Coin $coinBase) use (&$coinCombinations) {
            return $this->coins->each(function (Coin $coinConvert) use (&$coinBase, &$coinCombinations) {
                if ($coinBase->id === $coinConvert->id) return;

                $coinCombinations->push([ $coinBase->name, $coinConvert->name]);
            });
        });

        return $coinCombinations->toArray();
    }

    private function upsertCoinPrices(array $coinPrices): void
    {
        $upserts = collect();
        foreach ($coinPrices as $coinPrice) {
            $upserts->push([
                'coin_base_id' => $this->filterCoinPerName($coinPrice['code'])->id,
                'coin_convert_id' => $this->filterCoinPerName($coinPrice['codein'])->id,
                'name' => $coinPrice['name'],
                'value' => $coinPrice['high'],
                'reference' => date('Y-m-d', $coinPrice['timestamp'])
            ]);
        }

        CoinPrice::upsert(
            $upserts->toArray(),
            [
                'coin_base_id',
                'coin_convert_id',
                'reference'
            ],
            ['value']
        );
    }

    private function filterCoinPerName(string $name): Coin
    {
        return $this->coins->filter(function (Coin $coin) use (&$name) {
            return $coin->name === $name;
        })->first();
    }
}
