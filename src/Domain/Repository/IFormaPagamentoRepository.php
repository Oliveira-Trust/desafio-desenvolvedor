<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Repository;

use OT\ConversorMoedas\Domain\Shared\BaseEntity;
use OT\ConversorMoedas\Domain\Shared\IBaseRepository;

interface IFormaPagamentoRepository extends IBaseRepository
{
    public function findBySigla(string $sigla): BaseEntity;
}
