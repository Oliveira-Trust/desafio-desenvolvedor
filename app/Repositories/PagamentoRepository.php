<?php

namespace App\Repositories;

use App\Contracts\PagamentoInterface;
use App\Models\Pagamento;

class PagamentoRepository implements PagamentoInterface
{
    private $model;

    public function __construct(Pagamento $model)
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
