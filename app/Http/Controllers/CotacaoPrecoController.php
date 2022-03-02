<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveConversaoRequest;
use App\Models\CotacaoPreco;
use App\Models\MeiosPagamento;
use App\Models\TaxasConversao;
use Illuminate\Http\Request;
use App\Repositories\TaxaConversaoRepository;
use Illuminate\Support\Facades\Auth;
use App\Services\ContacaoMoedaClientService;

class CotacaoPrecoController extends Controller
{

    /** @var  TaxaConversaoRepository */
    private $taxaConversaoRepository;

    public function __construct(TaxaConversaoRepository $taxaConversaoRepo)
    {
        $this->taxaConversaoRepository = $taxaConversaoRepo;
    }

    public function index()
    {
        $meioPagamentos = $payment_methods = MeiosPagamento::all();
        $moedaOrigem = $this->taxaConversaoRepository->instance()->getMoedaOrigem;
        $moedaDestino = $this->taxaConversaoRepository->instance()->getMoedaDestino;

        $cotacoes = CotacaoPreco::where('user_id', Auth::user()->id)->get();

        return view('cotacaoPreco.index', compact('meioPagamentos', 'moedaOrigem', 'moedaDestino', 'cotacoes'));
    }

    public function save(SaveConversaoRequest $request)
    {
        $request = $request->all();

        $destino_moeda      = $request['destino_meda'];
        $valor              = $request['valor'];
        $meio_pagamento_id  = $request['meio_pagamento_id'];

        $cotacao_moeda_client  = new ContacaoMoedaClientService();
        $valor_moeda           = $cotacao_moeda_client->getPrecoMoeda($destino_moeda);

        if (!$valor_moeda) {
            return redirect()->back()->with('error', 'Erro ao fazer a conversão');
        }

        $taxa_pagamento = CotacaoPreco::getPagamentoTaxa($valor, $meio_pagamento_id);
        $taxa_conversao = TaxasConversao::getTaxaConversao($valor);
        $desconto       = $valor - $taxa_pagamento - $taxa_conversao;
        $preco_compra   = CotacaoPreco::getPrecoCompra($desconto, $valor_moeda);

        CotacaoPreco::create([
            'user_id'           => Auth::user()->id,
            'meio_pagamento_id' => $meio_pagamento_id,
            'origem_moeda'      => 'BRL',
            'destino_meda'      => $destino_moeda,
            'valor'             => $valor,
            'valor_moeda'       => $valor_moeda,
            'preco_compra'      => $preco_compra,
            'taxa_pagamento'    => $taxa_pagamento,
            'taxa_conversao'    => $taxa_conversao,
        ]);

        return redirect()->route('cotacao-preco.index')->with('success', 'Dados inseridos com sucesso!');
    }
}
