<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function create(array $data) : Model;
    public function update(Model $model, array $data): Model;
    public function find(int $id) : ?Model;
    public function findBy(array $data) : Builder;
    public function findCollectionBy(array $data) : Collection;
    public function findOneBy(array $data) : ?Model;
    public function getAll(
        array $columns = ['*'],
        string $orderBy = 'default',
        string $orderByDirection = 'asc'
    ) : Collection;
}
