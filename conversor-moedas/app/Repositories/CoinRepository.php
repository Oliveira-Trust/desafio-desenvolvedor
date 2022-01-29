<?php

namespace App\Repositories;

use App\Models\Coin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CoinRepository extends BaseRepository
{
    protected string $modelReference = Coin::class;

    public function withRelations(Collection $relations): Builder
    {
        $query = $this->model::query();

        $relations->each(function (string $relation) use (&$query) {
            $query->$relation();
        });

        return $query;
    }
}
