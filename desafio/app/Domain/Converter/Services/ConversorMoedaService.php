<?php

namespace App\Domain\Converter\Services;

use App\Domain\Converter\Repositories\ConversorMoedaRepository;
use App\Domain\Infrastructure\BuscadorTaxaCambio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class ConversorMoedaService
{
    private float $taxaCambio;

    private float $valor;

    private string $formaPagamento;

    private float $taxaPagamento;

    private float $taxaConversao;

    private float $valorConvertido;

    public function __construct(
        private readonly ConversorMoedaRepository $conversorMoedaRepository,
        private readonly BuscadorTaxaCambio       $buscadorTaxaCambio
    )
    {
    }

    public function historico(array $data): LengthAwarePaginator
    {
        return $this->conversorMoedaRepository->historico($data);
    }

    public function converter(array $data): Model|Builder
    {
        $this->valor = $data['valor'];
        $this->formaPagamento = $data['forma_pagamento'];
        $taxaCambio = $this->obterTaxaCambio($data['moeda_destino']);
        $this->definirTaxaCambio($taxaCambio);
        $this->realizarConversao();
        return $this->conversorMoedaRepository->salvar($this->obterResultado($data['moeda_destino']));

    }

    private function obterTaxaCambio(string $moedaDestino): float
    {
        return $this->buscadorTaxaCambio->obterTaxaCambio($moedaDestino);
    }

    private function calcularTaxas(): void
    {
        $this->taxaPagamento = $this->calcularTaxaPagamento();
        $this->taxaConversao = $this->calcularTaxaConversao();
    }

    private function definirTaxaCambio(float $taxaCambio): void
    {
        $this->taxaCambio = $taxaCambio;
    }

    private function realizarConversao(): void
    {
        $this->calcularTaxas();
        $valorFinal = $this->valor - $this->taxaPagamento - $this->taxaConversao;
        $this->valorConvertido = $valorFinal * $this->taxaCambio;
    }

    private function calcularTaxaPagamento(): float
    {
        return $this->formaPagamento === 'boleto' ? $this->valor * 0.0145 : $this->valor * 0.0763;
    }

    private function calcularTaxaConversao(): float
    {
        return $this->valor < 3000 ? $this->valor * 0.02 : $this->valor * 0.01;
    }

    private function obterResultado(string $moedaDestino): array
    {
        return [
            'public_id' => Str::uuid(),
            'valor' => $this->valor,
            'moeda_origem' => 'BRL',
            'moeda_destino' => $moedaDestino,
            'taxa_cambio' => $this->taxaCambio,
            'taxa_pagamento' => $this->taxaPagamento,
            'taxa_conversao' => $this->taxaConversao,
            'taxas_totais' => $this->taxaPagamento + $this->taxaConversao,
            'valor_final' => $this->valor - $this->taxaPagamento - $this->taxaConversao,
            'valor_convertido' => $this->valorConvertido,
            'forma_pagamento' => $this->formaPagamento,
            'user_id' => Auth::id(),
        ];
    }
}
