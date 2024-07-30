<?php

namespace App\Domain\Converter\Repositories;

use App\Domain\Converter\Entities\Transacao;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ConversorMoedaRepository
{
    public function __construct(
        private readonly Transacao $transacao
    ) {}

    public function historico(array $data): LengthAwarePaginator
    {
        return $this->transacao->query()
            ->orderBy('id', 'desc')
            ->paginate(
                perPage: $data['per_page'] ?? 5, page: $data['page'] ?? 1
            );
    }

    public function salvar(array $data): Model|Builder
    {
        return $this->transacao->query()->create($data);
    }
}
