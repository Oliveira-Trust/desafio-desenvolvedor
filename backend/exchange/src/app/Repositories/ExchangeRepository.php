<?php

namespace App\Repositories;

use App\Contracts\ExchangeRepositoryInterface;
use App\Models\Exchange;
use Illuminate\Support\Collection;

class ExchangeRepository implements ExchangeRepositoryInterface {

    public function getAll(array $relations = []): Collection {
        return Exchange::with($relations)->get();
    }

    public function findOrFail($id,array $relations = []): ?Exchange {
        return Exchange::with($relations)->findOrFail($id);
    }

    public function findOrFailByUserId($user_id, $id, array $relations = []): ?Exchange {
        return Exchange::with($relations)->where('user_id', $user_id)->findOrFail($id);
    }

    public function getAllByUserId($user_id, array $relations = []): Collection {
        return Exchange::with($relations)->where('user_id', $user_id)->get();
    }
}
