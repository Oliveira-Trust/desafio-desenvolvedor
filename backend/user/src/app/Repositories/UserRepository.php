<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface {

    public function getAll(): Collection {
        return User::all();
    }

    public function findOrFail($id): ?User {
        return User::findOrFail($id);
    }

    public function delete($id): ?bool {
        return User::where('id', $id)->delete();
    }

    public function create(array $data): User {
        return User::create($data);
    }

    public function update($id, array $data): User {

        $fee = $this->findOrFail($id);

        $fee->update($data);

        return $fee;
    }
}
