<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface {
    public function getAll(): Collection;

    public function findOrFail($id): ?User;

    public function delete($id): ?bool;

    public function create(array $data): User;

    public function update($id, array $data): User;
}
