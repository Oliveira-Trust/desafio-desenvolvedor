<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Cotacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MoedaController extends Controller
{
    protected $moeda_destino;

    public function index() {
        $historicos_cotacoes = Cotacao::find_by_user();

        return view('welcome', compact('historicos_cotacoes'));
    }

    public function create(\App\Http\Requests\CotacaoRequest $request) {

        $params_add_table = array(); // array usado para adicionar no banco
        $params_add_table['user_id'] = Auth::user()->id;
        $params_add_table['valor_conversao'] = $request->valor_conversao;
        $params_add_table['moeda_destino'] = $request->moeda_destino;
        $params_add_table['forma_pagamento'] = $request->forma_pagamento;

        // Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
        // Para pagamentos em boleto, taxa de 1,45%
        // Para pagamentos em cartão de crédito, taxa de 7,63%
        $taxa_pagamento = $request->forma_pagamento == 2 ? 7.63 : 1.45;

        // Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00,
        // essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.
        $taxa_conversao = $request->valor_conversao < 3000 ? 2 : 1;

        // Taxa de pagamento:
        $params_add_table['taxa_pagamento'] = ($request->valor_conversao * $taxa_pagamento) / 100;

        // Taxa de conversão:
        $params_add_table['taxa_conversao'] = ($request->valor_conversao * $taxa_conversao) / 100;

        // Valor utilizado para conversão descontando as taxas:
        $params_add_table['valor_conversao_desconto_taxas'] = $request->valor_conversao - $params_add_table['taxa_pagamento'] - $params_add_table['taxa_conversao'];

        // api cotação moeda
        $this->moeda_destino = $request->moeda_destino;
        $params_add_table['valor_moeda_destino'] = $this->api_cotacao_moeda_destino();

        $params_add_table['valor_comprado_moeda_destino'] = $params_add_table['valor_conversao_desconto_taxas'] / $params_add_table['valor_moeda_destino'];

        Cotacao::create($params_add_table);

        Session::flash('alert-success', 'Cadastro Realizado com Sucesso!');

        return back()->withInput();

    }

    protected function api_cotacao_moeda_destino(){
        $endpoint = "https://economia.awesomeapi.com.br/json/last/".$this->moeda_destino."-BRL";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $valor_cotacao_moeda_destino = $content[$this->moeda_destino.'BRL']['bid'];

        return $valor_cotacao_moeda_destino;
    }
}
