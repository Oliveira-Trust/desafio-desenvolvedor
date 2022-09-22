<?php

namespace App\Services;

use App\Models\Configuracao;
use App\Models\Conversao;
use Illuminate\Support\Facades\Session;

class ConversaoService
{
    /**
     * @var CotacaoAPI
     */
    private $cotacao;
    private $configuracoes;

    public function __construct(CotacaoAPI $cotacao)
    {
        $this->cotacao = $cotacao;
        $this->configuracoes = Configuracao::findOrFail(1);
    }

    public function calcula(string $moeda_origem, string $moeda_destino, float $valor, string $forma_pagamento)
    {

        if (!$this->checaValor($valor)) {
            return false;
        }

        $cotacao = $this->cotacao->cotar($moeda_origem, $moeda_destino);

        $taxa_forma_pagto = $this->verificaTaxaFormaPagamento($forma_pagamento, $valor);

        $taxa_conversao = $this->verificaTaxaConversao($valor);

        $valor_convertido = ($valor - $taxa_forma_pagto - $taxa_conversao) / $cotacao->bid;

        $calculo = $this->gravaConversao($moeda_origem, $moeda_destino, $valor, $forma_pagamento, $cotacao, $valor_convertido, $taxa_forma_pagto, $taxa_conversao);

        return $calculo;
    }

    public function checaValor($valor)
    {
        if ($valor < 1000 || $valor > 100000) {
            Session::flash('alert-warning', 'O valor da conversão precisa estar entre R$ 1.000,00 até R$ 100.000,00');
            return false;
        }

        return true;

    }

    public function verificaTaxaFormaPagamento(string $forma_pagamento, float $valor): float
    {
        if ($forma_pagamento == 'Boleto') {
            $taxa_forma_pagto = ($valor * $this->configuracoes->taxa_boleto) / 100;
        }

        if ($forma_pagamento == 'Cartao') {
            $taxa_forma_pagto = ($valor * $this->configuracoes->taxa_cartao) / 100;
        }
        return $taxa_forma_pagto;
    }

    public function verificaTaxaConversao(float $valor): float
    {
        if ($valor < 3000) {
            $taxa_conversao = ($valor * $this->configuracoes->taxa_conversao_abaixo_3mil) / 100;
            return $taxa_conversao;
        }

        $taxa_conversao = ($valor * $this->configuracoes->taxa_conversao_acima_3mil) / 100;
        return $taxa_conversao;
    }

    public function gravaConversao(string $moeda_origem, string $moeda_destino, float $valor, string $forma_pagamento, $cotacao, float $valor_convertido, float $taxa_forma_pagto, float $taxa_conversao): Conversao
    {
        $conversao = new Conversao();
        $conversao->usuario_id = \Auth::id();
        $conversao->moeda_origem = $moeda_origem;
        $conversao->moeda_destino = $moeda_destino;
        $conversao->valor_solicitado = $valor;
        $conversao->forma_pagamento = $forma_pagamento;
        $conversao->cotacao_moeda_destino = $cotacao->bid;
        $conversao->valor_convertido = $valor_convertido;
        $conversao->taxa_pagamento = $taxa_forma_pagto;
        $conversao->taxa_conversao = $taxa_conversao;
        $conversao->save();

        return $conversao;
    }


}
