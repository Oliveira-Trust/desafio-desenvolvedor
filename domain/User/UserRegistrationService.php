<?php

namespace Oliveiratrust\User;

use Oliveiratrust\Models\User\User;

class UserRegistrationService {

    public function __construct(
        private User $model
    ){}

    public function registration(array $data): User
    {
        return $this->model->create($data);
    }
}
