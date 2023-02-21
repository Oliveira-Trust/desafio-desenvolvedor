<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Repository;

use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Entity\Conversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TaxaConversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

interface IConversaoRepository
{
    public function findTaxaConversaoByValor(float|ValorCompra $valor): TaxaConversao;

    public function findMoedaBySigla(string $sigla): TipoMoeda;

    public function listAllMoedas(): Collection;

    public function create(Conversao $conversao): void;

    public function listAll(): Collection;
}
