<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Modules\User\Notifications\WelcomeNotification;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }

    public function findByColumn(array $data): ?User
    {
        return $this->userRepository->findByColumn($data);
    }

    /**
     * @param array $data
     * @return null|User
     */
    public function create(array $data): ?User
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->create($data);

        $user->notify(new WelcomeNotification($user));

        return $user;
    }
}
