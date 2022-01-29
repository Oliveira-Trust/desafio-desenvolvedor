<?php

namespace App\Actions;

use App\Http\Resources\CoinCollection;
use App\Models\Coin;
use App\Repositories\CoinRepository;
use BadMethodCallException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CoinListAction
{
    public function execute(string $request)
    {
        $with = $this->extractRelationsFromRequest($request);
        if ($with->isEmpty()) {
            return Cache::get('coins', fn () => new CoinCollection(Coin::all()));
        }

        try {
            $coinsQuery = (new CoinRepository)->withRelations($with);
        } catch (BadMethodCallException $e) {
            return response([
                'errors' => [ 'Non-existent relations' ],
                'status' => 404
            ], 404);
        }

        return Cache::get('coins?with=' . $request, fn () => new CoinCollection($coinsQuery->get()));
    }

    private function extractRelationsFromRequest(string $request): Collection
    {
        return collect(explode(',', $request))
            ->filter(fn (string $relation) => !empty($relation))
            ->map(fn (string $relation) => 'with' . Str::ucfirst($relation));
    }
}
