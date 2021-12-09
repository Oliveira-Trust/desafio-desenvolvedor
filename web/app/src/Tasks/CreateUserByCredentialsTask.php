<?php

namespace App\Tasks;

class CreateUserByCredentialsTask
{
    public function run(array $data): bool
    {
        try {
            return app()->auth()->registerUser(
                $data['fullname'],
                $data['email'],
                $data['password'],
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
