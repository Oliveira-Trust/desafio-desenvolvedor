<?php

namespace App\Services\User;

use App\Services\User\UserServiceContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceContract
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getById(int $id)
    {
        return $this->userRepository->getById($id);
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->userRepository->getByAttribute($field, $attribute);
    }

    public function store(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->store($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->userRepository->updateById($data, $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id)
            ->delete();
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->userRepository->logout();
    }
}
