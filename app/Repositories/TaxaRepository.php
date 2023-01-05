<?php

namespace App\Repositories;

use App\Contracts\TaxaInterface;
use App\Models\Taxa;

class TaxaRepository implements TaxaInterface
{
    private $model;

    public function __construct(Taxa $model)
    {
        $this->model = $model;
    }

    public function listarDoUsuario(string $userId)
    {
        return $this->model->whereUserId($userId)->get();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(string $id)
    {
        // TODO: Implement delete() method.
    }
}
