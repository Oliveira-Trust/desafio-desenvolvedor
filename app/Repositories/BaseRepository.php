<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
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
}
