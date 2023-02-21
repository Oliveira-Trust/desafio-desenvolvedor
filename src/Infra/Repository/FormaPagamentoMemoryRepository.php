<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Repository;

use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Entity\FormaPagamento;
use OT\ConversorMoedas\Domain\Exceptions\FormaPagamentoNotFoundException;
use OT\ConversorMoedas\Domain\Repository\IFormaPagamentoRepository;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;

class FormaPagamentoMemoryRepository implements IFormaPagamentoRepository
{
    private static int $sequence = 0;

    private static Collection $lista;

    public function __construct()
    {
        self::$lista = new Collection();
        $this->populaDados();
    }

    public function fetchAll(): Collection
    {
        return self::$lista;
    }

    public function findByID(string $ID): BaseEntity
    {
        $filtered = self::$lista->filter(function ($value) use ($ID) {
            return $value->getID()->toString() == $ID;
        });
        $entity = $filtered->first();

        if (! $entity) {
            throw new FormaPagamentoNotFoundException();
        }

        return $entity;
    }

    public function findBySigla(string $sigla): BaseEntity
    {
        $filtered = self::$lista->filter(function ($value) use ($sigla) {
            return $value->getSigla() == $sigla;
        });

        $entity = $filtered->first();

        if (! $entity) {
            throw new FormaPagamentoNotFoundException();
        }

        return $entity;
    }

    public function populaDados()
    {
        self::$sequence++;
        self::$lista->add(new FormaPagamento('Boleto', 'BLT', 1.45));
        self::$lista->add(new FormaPagamento('Cartão de Crédito', 'CC', 7.63));
        self::$lista->add(new FormaPagamento('Cartão de Débito', 'CD', 4.70));
    }
}
