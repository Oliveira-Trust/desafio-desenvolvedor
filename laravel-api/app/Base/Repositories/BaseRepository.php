<?php

declare(strict_types=1);

namespace App\Base\Repositories;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected string $model;

    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    public function findAll(): Collection
    {
        return $this->model::all();
    }

    public function find(int $id): Model
    {
        return $this->model::findOrFail($id);
    }
}
