<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Http\Requests\ObterCotacaoRequest;
use App\Http\Requests\ConverterValorRequest;
use App\Http\Resources\CotacaoResource;
use App\Http\Resources\ConversaoResource;
use App\Models\HistoricoConversao;
use App\Models\Taxa;
use App\Notifications\ConversaoEfetuada;
use Illuminate\Support\Facades\Notification;

class CotacaoController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function obterCotacao(ObterCotacaoRequest $request)
    {
        $moedaOrigem = $request->input('moeda_origem');
        $moedaDestino = $request->input('moeda_destino');

        $data = $this->apiService->obterCotacao($moedaOrigem, $moedaDestino);

        if ($data) {
            return new CotacaoResource((object)[
                'moeda_origem' => $moedaOrigem,
                'moeda_destino' => $moedaDestino,
                'cotacao' => $data,
                'data' => now(),
            ]);
        } else {
            return response()->json(['error' => 'Erro ao obter cotação'], 500);
        }
    }

    public function converterValor(ConverterValorRequest $request)
    {
        $moedaOrigem = $request->input('moeda_origem');
        $moedaDestino = $request->input('moeda_destino');
        $valor = $request->input('valor');
        $formaPagamento = $request->input('forma_pagamento');

        $dataOrigemDestino = $this->apiService->obterCotacao($moedaOrigem, $moedaDestino);
        $bidDestino = $this->apiService->obterBidDestino($moedaDestino);

        if ($dataOrigemDestino && $bidDestino !== null) {
            $cotacaoKey = "{$moedaOrigem}{$moedaDestino}";
            if (isset($dataOrigemDestino[$cotacaoKey])) {
                $taxaCompra = $dataOrigemDestino[$cotacaoKey]['bid'];

                $taxaFormaPagamento = Taxa::where('TAXA', $formaPagamento === 'Boleto' ? 'BO' : 'CC')->first()->VALOR;
                $taxaConversao = Taxa::where('TAXA', $valor < 3000 ? 'CME' : 'CMA')->first()->VALOR;

                $valorComTaxaPagamento = $valor - ($valor * $taxaFormaPagamento);
                $valorComTaxaConversao = $valorComTaxaPagamento - ($valor * $taxaConversao);
                $valorConvertido = $valorComTaxaConversao * $taxaCompra;

                HistoricoConversao::create([
                    'moeda_origem' => $moedaOrigem,
                    'moeda_destino' => $moedaDestino,
                    'valor_para_conversao' => $valor,
                    'forma_pagamento' => $formaPagamento,
                    'bid_destino' => $bidDestino,
                    'valor_comprado' => $valorConvertido,
                    'taxa_pagamento' => $valor * $taxaFormaPagamento,
                    'taxa_conversao' => $valor * $taxaConversao,
                    'valor_utilizado_para_conversao' => $valorComTaxaConversao,
                ]);

                // Dados para a notificação
                $notificationData = (object)[
                    'moeda_origem' => $moedaOrigem,
                    'moeda_destino' => $moedaDestino,
                    'valor_para_conversao' => $valor,
                    'forma_pagamento' => $formaPagamento,
                    'bid_destino' => $bidDestino,
                    'valor_comprado' => $valorConvertido,
                    'taxa_pagamento' => $valor * $taxaFormaPagamento,
                    'taxa_conversao' => $valor * $taxaConversao,
                    'valor_utilizado_para_conversao' => $valorComTaxaConversao,
                ];

                // Envia a notificação de e-mail
                Notification::route('mail', 'user@example.com')->notify(new ConversaoEfetuada($notificationData));

                return new ConversaoResource($notificationData);
            } else {
                return response()->json(['error' => 'Cotação não encontrada'], 404);
            }
        } else {
            return response()->json(['error' => 'Erro ao obter cotação'], 500);
        }
    }
}
