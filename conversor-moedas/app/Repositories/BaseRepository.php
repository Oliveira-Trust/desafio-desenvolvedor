<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected string $modelReference;
    protected Model $model;

    public function __construct()
    {
        $this->model = new $this->modelReference();
    }
}
