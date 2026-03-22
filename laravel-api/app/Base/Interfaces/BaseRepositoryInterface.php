<?php

declare(strict_types=1);

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function save(Model $model): Model;

    public function findAll(): Collection;

    public function find(int $id): Model;
}
