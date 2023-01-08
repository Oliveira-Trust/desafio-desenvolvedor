<?php

namespace App\Contracts;

use App\Models\Fee;
use Illuminate\Support\Collection;

interface FeeRepositoryInterface {
    public function getAll(): Collection;

    public function findOrFail($id): ?Fee;

    public function delete($id): ?bool;

    public function create(array $data): Fee;

    public function update($id, array $data): Fee;
}
