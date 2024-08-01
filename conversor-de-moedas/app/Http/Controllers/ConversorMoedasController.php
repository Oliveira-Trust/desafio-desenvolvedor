<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotacaoRealizada;
use Illuminate\Validation\ValidationException;

class ConversorMoedasController extends Controller
{
    public function exibirHomeConversor()
    {
        return view('conversor/home-conversor');
    }

    public function index()
    {
        $data = [
            'moedaDestino' => null,
            'quantidade' => null,
            'metodoPagamento' => null,
            'taxaDeConversao' => null,
            'taxaDePagamento' => null,
            'taxaDeConversaoAdicional' => null,
            'quantidadeAposTaxas' => null,
            'quantidadeConvertida' => null,
            'valorMoedaDestinoUsadoParaConversao' => null,
            'nomeMoedaDestino' => null,
            'valorMoedaDestinoInput' => null,
            'taxaPagamentoInput' => null,
            'taxaConversaoAdicionalInput' => null
        ];

        return view('conversor/formulario-cotacao', $data);
    }

    public function converter(Request $request)
    {
        try {
            $request->validate([
                'moedaDestino' => 'required|string',
                'quantidade' => 'required|numeric|min:1000|max:100000',
                'metodoPagamento' => 'required|string|in:boleto,cartao_de_credito',
                'valor-moeda-destino' => 'nullable|numeric',
                'taxa-pagamento' => 'nullable|numeric',
                'taxa-conversao-adicional' => 'nullable|numeric'
            ]);

            $moedaDestino = $request->input('moedaDestino');
            $quantidade = $request->input('quantidade');
            $metodoPagamento = $request->input('metodoPagamento');

            // Obter a taxa de conversão da moeda
            $taxaDeConversao = $request->input('valor-moeda-destino') ?: $this->obterTaxaDeConversao($moedaDestino);

            // Calcular as taxas de pagamento e conversão adicional
            $taxaDePagamento = $request->input('taxa-pagamento') ?: $this->calcularTaxaDePagamento($quantidade, $metodoPagamento);
            $taxaDeConversaoAdicional = $request->input('taxa-conversao-adicional') ?: $this->calcularTaxaDeConversaoAdicional($quantidade);

            // Valor após deduzir as taxas
            $quantidadeAposTaxas = $quantidade - $taxaDePagamento - $taxaDeConversaoAdicional;

            // Calcular o valor convertido
            if ($taxaDeConversao == 0) {
                throw new \Exception('Taxa de conversão inválida.');
            }

            $quantidadeConvertida = $quantidadeAposTaxas / $taxaDeConversao;

            // Adiciona o valor da "Moeda de destino" usado para conversão
            $valorMoedaDestinoUsadoParaConversao = $taxaDeConversao;

            // Nome da moeda para exibição
            $nomeMoedaDestino = $this->nomeMoeda($moedaDestino);

            $dadosCotacao = [
                'moedaDestino' => $moedaDestino,
                'quantidade' => $quantidade,
                'metodoPagamento' => $metodoPagamento,
                'taxaDeConversao' => number_format($taxaDeConversao, 2, ',', '.'),
                'taxaDePagamento' => number_format($taxaDePagamento, 2, ',', '.'),
                'taxaDeConversaoAdicional' => number_format($taxaDeConversaoAdicional, 2, ',', '.'),
                'quantidadeAposTaxas' => number_format($quantidadeAposTaxas, 2, ',', '.'),
                'quantidadeConvertida' => number_format($quantidadeConvertida, 2, ',', '.'),
                'valorMoedaDestinoUsadoParaConversao' => number_format($valorMoedaDestinoUsadoParaConversao, 2, ',', '.'),
                'nomeMoedaDestino' => $nomeMoedaDestino,
                'valorMoedaDestinoInput' => $request->input('valor-moeda-destino'),
                'taxaPagamentoInput' => $request->input('taxa-pagamento'),
                'taxaConversaoAdicionalInput' => $request->input('taxa-conversao-adicional')
            ];

            session(['dados_cotacao' => $dadosCotacao]);
            return view('conversor/formulario-cotacao', $dadosCotacao);

        } catch (ValidationException $e) {
            // Tratar erros de validação
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Tratar erros gerais
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    private function obterTaxaDeConversao($moeda)
    {
        $moedasPermitidas = ['USD', 'EUR', 'GBP', 'JPY', 'AUD'];
        if (!in_array($moeda, $moedasPermitidas)) {
            abort(400, 'Moeda não suportada.');
        }

        $urlDaApi = 'https://economia.awesomeapi.com.br/json/last/BRL-' . $moeda;
        try {
            $resposta = Http::get($urlDaApi)->json();
            if (isset($resposta["BRL$moeda"]['ask'])) {
                // Garantir que a taxa de conversão seja um valor numérico
                return (float) $resposta["BRL$moeda"]['ask'];
            } else {
                throw new \Exception('Não foi possível obter a taxa de conversão.');
            }
        } catch (\Exception $e) {
            throw new \Exception('Erro ao acessar a API: ' . $e->getMessage());
        }
    }

    private function calcularTaxaDePagamento($quantidade, $metodoPagamento)
    {
        $taxa = $metodoPagamento == 'boleto' ? 0.0145 : 0.0763;
        return $quantidade * $taxa;
    }

    private function calcularTaxaDeConversaoAdicional($quantidade)
    {
        $taxa = $quantidade < 3000 ? 0.02 : 0.01;
        return $quantidade * $taxa;
    }

    private function nomeMoeda($moeda)
    {
        $nomes = [
            'USD' => 'Dólar Americano',
            'EUR' => 'Euro',
            'GBP' => 'Libra Esterlina',
            'JPY' => 'Iene Japonês',
            'AUD' => 'Dólar Australiano'
        ];
        return $nomes[$moeda] ?? 'Desconhecida';
    }

    public function enviarEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            // Obter os dados da cotação da sessão
            $dadosCotacao = session('dados_cotacao');

            // Verificar se os dados da cotação existem
            if (!$dadosCotacao) {
                throw new \Exception('Nenhum dado de cotação encontrado na sessão.');
            }

            // Enviar o e-mail usando a view cotacao_realizada
            Mail::to($request->input('email'))->send(new CotacaoRealizada($dadosCotacao));

            return response()->json(['message' => 'E-mail enviado com sucesso!']);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Email inválido.'], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
