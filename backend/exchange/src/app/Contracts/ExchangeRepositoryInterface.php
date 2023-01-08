<?php

namespace App\Contracts;

use App\Models\Exchange;
use Illuminate\Support\Collection;

interface ExchangeRepositoryInterface {
    public function getAll(array $relations = []): Collection;

    public function findOrFail($id, array $relations = []): ?Exchange;

    public function findOrFailByUserId($user_id, $id, array $relations = []): ?Exchange;

    public function getAllByUserId($user_id, array $relations = []): Collection;
}
