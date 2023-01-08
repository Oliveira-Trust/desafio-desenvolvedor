<?php

namespace App\Services\Auth;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class SignupService {

    private UserRepositoryInterface $user_repository;

    public function __construct(private string $name, private string $email, private string $password) {
        $this->user_repository = app(UserRepositoryInterface::class);
    }

    public function execute(): User {

        $user = $this->user_repository->create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ]);

        return $user;
    }
}
