<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Repository;

use App\Models\FormaPagamento as ModelFormaPagamento;
use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Entity\FormaPagamento;
use OT\ConversorMoedas\Domain\Exceptions\FormaPagamentoNotFoundException;
use OT\ConversorMoedas\Domain\Repository\IFormaPagamentoRepository;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;

class FormaPagamentoEloquentRepository implements IFormaPagamentoRepository
{
    public function __construct(private ModelFormaPagamento $model)
    {
    }

    public function fetchAll(): Collection
    {
        $registros = $this->model->all();

        $entities = $registros->map(function ($item, $key) {
            return new FormaPagamento($item->nome, $item->sigla, $item->taxa, $item->_ID);
        });

        return new Collection($entities->all());
    }

    public function findByID(string $ID): BaseEntity
    {
        $registro = $this->model->where('_ID', $ID)->first();

        if (! $registro) {
            throw new FormaPagamentoNotFoundException();
        }

        $entity = new FormaPagamento($registro->nome, $registro->sigla, $registro->taxa, $registro->_ID);

        return $entity;
    }

    public function findBySigla(string $sigla): BaseEntity
    {
        $registro = $this->model->where('sigla', $sigla)->first();

        if (! $registro) {
            throw new FormaPagamentoNotFoundException();
        }

        $entity = new FormaPagamento($registro->nome, $registro->sigla, $registro->taxa, $registro->_ID);

        return $entity;
    }
}
