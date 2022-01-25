<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected string $model;

    public function createModel(): Model
    {
        return new $this->model;
    }
}