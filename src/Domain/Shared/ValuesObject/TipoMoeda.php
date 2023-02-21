<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared\ValuesObject;

class TipoMoeda
{
    //MELHORIA: validação se tipo de moeda eh valido/aceito pelo conversor
    public function __construct(private string $sigla, private string $nome)
    {
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function __toString(): string
    {
        return $this->sigla.' - '.$this->nome;
    }
}
