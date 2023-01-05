<?php

namespace App\Contracts;

interface PagamentoInterface
{
    public function listarDoUsuario(string $userId);

    public function store(array $data);

    public function update(string $id, array $data);

    public function delete(string $id);
}
