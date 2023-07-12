<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->model->where($field, $attribute);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)
            ->delete();
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
    }
}
