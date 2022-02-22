<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public function create(array $data) : Model;
    public function find(int $id) : ?Model;
    public function getAll(
        $columns = ['*'],
        string $orderBy = 'default',
        string $orderByDirection = 'asc'
    ) : Collection;
}
