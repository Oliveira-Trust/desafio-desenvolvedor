<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $user)
    {
    }

    public function findByColumn(array $data)
    {
        return $this->user->where($data)->first();
    }

    /**
     * @param array $data
     * @return null|User
     */
    public function create(array $data): ?User
    {
        return $this->user->create($data);
    }
}
