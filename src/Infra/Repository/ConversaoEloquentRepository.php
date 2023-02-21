<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Repository;

use App\Models\Conversao as ModelConversao;
use App\Models\TaxaConversao as ModelTaxaConversao;
use App\Models\TipoMoeda as ModelTipoMoeda;
use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Entity\Conversao;
use OT\ConversorMoedas\Domain\Exceptions\MoedaNotFoundException;
use OT\ConversorMoedas\Domain\Exceptions\TaxaConversaoNotFoundException;
use OT\ConversorMoedas\Domain\Repository\IConversaoRepository;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TaxaConversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

class ConversaoEloquentRepository implements IConversaoRepository
{
    public function __construct(private ModelTipoMoeda $modelTipoMoeda, private ModelTaxaConversao $modelTaxaConversao, private ModelConversao $model)
    {
    }

    public function findTaxaConversaoByValor(float|ValorCompra $valor): TaxaConversao
    {
        $valorBusca = ($valor instanceof ValorCompra) ? $valor->getValue() : $valor;
        $registro = $this->modelTaxaConversao->whereRaw('? between valorMin and valorMax', [$valorBusca])->first();
        if (! $registro) {
            throw new TaxaConversaoNotFoundException();
        }

        $entity = new TaxaConversao($registro->taxa, $registro->valorMin, $registro->valorMax);

        return $entity;
    }

    public function findMoedaBySigla(string $sigla): TipoMoeda
    {
        $registro = $this->modelTipoMoeda->where('sigla', $sigla)->first();

        if (! $registro) {
            throw new MoedaNotFoundException();
        }

        $entity = new TipoMoeda($registro->sigla, $registro->nome);

        return $entity;
    }

    public function listAllMoedas(): Collection
    {
        $registros = $this->modelTipoMoeda->all();

        $entities = $registros->map(function ($item, $key) {
            return new TipoMoeda($item->sigla, $item->nome);
        });

        return new Collection($entities->all());
    }

    public function create(Conversao $conversao): void
    {
        $this->model->_ID = $conversao->getID();
        $this->model->moeda_origem = $conversao->getMoedaOrigem();
        $this->model->moeda_destino = $conversao->getMoedaDestino();
        $this->model->valor_compra = $conversao->getValorCompra();
        $this->model->forma_pgto = $conversao->getFormaPagamento();
        $this->model->perc_taxa_pgto = $conversao->getPercentualTaxaPagamento();
        $this->model->taxa_pagamento = $conversao->getTaxaPagamento();
        $this->model->perc_taxa_conversao = $conversao->getPercentualTaxaPagamento();
        $this->model->taxa_conversao = $conversao->getTaxaConversao();
        $this->model->saldo_conversao = $conversao->getSaldoParaConversao();
        $this->model->valor_cotacao = $conversao->getValorCotacao();
        $this->model->valor_convertido = $conversao->getValorConvertido();
        $this->model->data = $conversao->getData();
        $this->model->user_id = auth()->user()->id ?? null;
        $this->model->save();
    }

    public function listAll(): Collection
    {
        $registros = $this->model->where('user_id', auth()->user()->id)->get();

        $entities = $registros->map(function ($item, $key) {
            return new Conversao(
                $item->moeda_origem,
                $item->moeda_destino,
                $item->valor_compra,
                $item->forma_pgto,
                $item->perc_taxa_pgto,
                $item->taxa_pagamento,
                $item->perc_taxa_conversao,
                $item->taxa_conversao,
                $item->saldo_conversao,
                $item->valor_cotacao,
                $item->valor_convertido,
                $item->data,
                $item->_ID
            );
        });

        return new Collection($entities->all());
    }
}
