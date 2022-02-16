<?php

namespace App\Service;

use Illuminate\Http\Request;
use App\Integrations\Traits\CambioServiceTrait;

class CambioService
{
    use CambioServiceTrait;

    private const TAXA_PG_CARTAO = 0.0763;
    private const TAXA_PG_BOLETO = 0.0145;
    private const TAXA_VALOR_BAIXO = 0.02;
    private const TAXA_VALOR = 0.01;

    private $resultado;
    private $valorTaxaPagamento;
    private $valorTaxaConversao;
    private $valorMoedaDestino;
    private $valorComDescontoAplicado;
    private $valorCompra;

    /**
     * Realiza os passos para aplicar a conversão para a moeda solictada
     *
     * @param Request $request
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function converter(Request $request) : array
    {
        $cambio = (array) $request->cambio;
        array_walk( $cambio, [$this, "executar"]);
        return $this->resultado;
    }

    /**
     * Método responsável por executar a conversão da moeda informada
     *
     * @param array $dadosSolcitacao
     * @return bool
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function executar(array $dadosSolcitacao) : bool
    {
        if ($this->combinacaoValida($dadosSolcitacao["moeda"]))
        {
            return !!$this->resultado[$dadosSolcitacao["moeda"]] = $this->realizarCompra($dadosSolcitacao["valor"], $dadosSolcitacao["forma_pagamento"], $dadosSolcitacao["moeda"]);
        }
        return !$this->resultado[$dadosSolcitacao["moeda"]] = ["error" => "Combinação inválida"];
    }

    /**
     * Método responsável por verificando se a moeda solicitada permite realizar a compra
     *
     * @param string $moeda
     * @return bool
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function combinacaoValida(string $moeda) : bool
    {
        $combincacoes = (new MoedasService)->combinacoes();
        return $combincacoes && count($combincacoes) && \array_key_exists('BRL-'.$moeda, $combincacoes);
    }

    /**
     * Realiza os passos necessários para a compra da moeda
     *
     * @param float $valorSolicitado
     * @param string $formaPagamento
     * @param string $moeda
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function realizarCompra(float $valorSolicitado, string $formaPagamento, string $moeda)
    {
        $this->aplicarTaxas($valorSolicitado, $formaPagamento)
             ->setValorMoedaDestino($moeda)
             ->setValorCompra();
        ;
        return $this->prepare(null, collect(\get_object_vars($this))->merge(compact("valorSolicitado", "formaPagamento", "moeda"))->toArray());
    }

    /**
     * Método responsável por aplicar as taxas da transação
     *
     * @param float $valorSolicitado
     * @param string $formaPagamento
     * @return self
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function aplicarTaxas(float $valorSolicitado, string $formaPagamento) : self
    {
        $this->setTaxaConversao($valorSolicitado)
             ->setTaxaFormaPagamento($valorSolicitado, $formaPagamento);
        $this->valorComDescontoAplicado = $valorSolicitado - ($this->valorTaxaConversao + $this->valorTaxaPagamento);
        return $this;
    }

    /**
     * Definindo o valor da cotação da moeda destino
     *
     * @param string $moeda
     * @return self
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function setValorMoedaDestino(string $moeda) : self
    {
        $cotacao = (new MoedasService)->cotacaoMoeda($moeda);
        $this->valorMoedaDestino = floatval(collect($cotacao)->first()?->bid);
        return $this;
    }

    /**
     * Definindo o taxa da conversão
     *
     * @param float $valorSolicitado
     * @return self
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function setTaxaConversao(float $valorSolicitado) : self
    {
        $this->valorTaxaConversao = $valorSolicitado < 3000 ? $valorSolicitado * self::TAXA_VALOR_BAIXO : $valorSolicitado * self::TAXA_VALOR;
        return $this;
    }

    /**
     * Definindo a taxa da forma de pagamento
     *
     * @param float $valorSolicitado
     * @param string $formaPagamento
     * @return self
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function setTaxaFormaPagamento(float $valorSolicitado, string $formaPagamento) : self
    {
        $this->valorTaxaPagamento =  $formaPagamento == 'BOLETO' ?  round($valorSolicitado * self::TAXA_PG_BOLETO, 2) : round($valorSolicitado * self::TAXA_PG_CARTAO, 2);
        return $this;
    }

    /**
     * Definindo o valor de compra
     *
     * @return void
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    private function setValorCompra()
    {
        $this->valorCompra = round($this->valorComDescontoAplicado / ($this->valorMoedaDestino ?: 1), 2);
    }
}