<?php

namespace App\Services;

use App\Helpers\ConversaoHelper;
use App\Models\Cotacao;
use Auth;
use Illuminate\Support\Facades\Http;

class GetCotacaoService
{
    const URL = "https://economia.awesomeapi.com.br/last/";

    public function __construct()
    {
    }

    public function getCotacao()
    {
        return Cotacao::all();
    }

    public function cotacao($origem, $destino, $valorConversao, $formaPagamento)
    {
        $url = self::URL . "{$destino}-{$origem}";

        $resposta = Http::acceptJson()->get($url);

        if (!$resposta->successful()) {
            return $resposta->throw();
        }

        $valor = (object)$resposta->json()[$destino . $origem];

        $taxa_pagamento = ConversaoHelper::getTaxasFormaPagamento($formaPagamento, $valorConversao);
        $taxa_conversao = ConversaoHelper::aplicarTaxaConversao($valorConversao);
        $valor_comprado = ($valorConversao - $taxa_pagamento) - $taxa_conversao;

        $dados = [
            'moeda_origem' => $origem,
            'moeda_destino' => $destino,
            'valor_conversao' => $valorConversao,
            'forma_pagamento' => $formaPagamento,
            'valor_moeda_destino' => $valor->bid,
            'valor_comprado_moeda_destino' => $valor_comprado,
            'taxa_pagamento' => $taxa_pagamento,
            'taxa_conversao' => $taxa_conversao,
            'valor_conversao_com_taxas' => $valorConversao
        ];

        return $this->salvarCotacao($dados);
    }

    private function salvarCotacao($dados)
    {
        $valor = Cotacao::create($dados);
        return response()->json(['cotacao' => $valor]);
    }
}
