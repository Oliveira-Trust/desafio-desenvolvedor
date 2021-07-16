<?php

namespace App\Repository\User\implementations;

use App\Repository\User\UserIRepository;
use App\Repository\User\UserDTO;
use App\Models\User;

class UserRepository implements UserIRepository {

    public function create(UserDTO $userDTO): bool {
        $user = new User($userDTO->toArray());
        $user->password = app('hash')->make($userDTO->password);
        $user->type = 'user';
        return $user->save();
    }

    public function read(int $id): array {

    }

    public function readAll(): array {

    }

    public function update(int $id, UserDTO $user) : bool {

    }

    public function delete(int $id) : bool {

    }
}