<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moedas;
use App\Models\Historico;
use App\Models\Taxas;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MoedasController extends Controller
{
    public function show($id=null){

        if($id==null){
            $moedas = Moedas::with('taxas')->get();
            return response([
                'moedas' => $moedas,
                'rows'=>$moedas->count(),
                'message' => 'Moedas encontradas com Sucesso!',
                'status' => true
            ]);
        }else{
            $moedas = Moedas::with('taxas')->find($id);
            return response([
                'moedas' => $moedas,
                'message' => 'Moeda encontrada com Sucesso!',
                'status' => true
            ]);
        }

    }

    public function create(Request $request){

        $moeda = $request->all();

        $taxa = $moeda['taxas'];

        unset($moeda['taxas']);

        $newMoeda = Moedas::create($moeda);

        $taxa['moeda_id'] = $newMoeda->id;

        $newTaxa = Taxas::create($taxa);

        $moedas = Moedas::with('taxas')->find($newMoeda->id);

        return response([
            'moedas' => $moedas,
            'message' => 'Moeda e Taxa Inserida com Sucesso',
            'status' => true
        ]);
    }

    public function update($id, Request $request){

        $moedas = Moedas::with('taxas')->find($id);

        $taxa = Taxa::find($moedas->taxas->id);

        $moedas->nome = ($request->nome==$moedas->nome) ? $moedas->nome:$request->nome;

        $moedas->sigla = ($request->sigla==$moedas->sigla) ? $moedas->sigla:$request->sigla;

        $moedas->save();

        $taxa->taxaConversaoMin = ($request->taxas->taxaConversaoMin==$taxa->taxaConversaoMin) ? $taxa->taxaConversaoMin:$request->taxas->taxaConversaoMin;

        $taxa->taxaConversaoMax = ($request->taxas->taxaConversaoMax==$taxa->taxaConversaoMax) ? $taxa->taxaConversaoMax:$request->taxas->taxaConversaoMax;

        $taxa->valor_controle = ($request->taxas->valor_controle==$taxa->valor_controle) ? $taxa->valor_controle:$request->taxas->valor_controle;

        $taxa->taxaCartao = ($request->taxas->taxaCartao==$taxa->taxaCartao) ? $taxa->taxaCartao:$request->taxas->taxaCartao;

        $taxa->taxaBoleto = ($request->taxas->taxaBoleto==$taxa->taxaBoleto) ? $taxa->taxaBoleto:$request->taxas->taxaBoleto;

        $taxa->save();

        $moeda = Moedas::with('taxas')->find($id);

        return response([
            'moedas' => $moeda,
            'message' => 'Moeda e Taxa Atualizadas com Sucesso',
            'status' => true
        ]);
    }

    public function delete($id){

        $moedas = Moedas::with('taxas')->find($id);

        $taxas = Taxa::find($moedas->taxas->id);

        $taxas->delete();

        $moedas->delete();

        return response([
            'message' => 'Moeda e Taxa Removidas com Sucesso',
            'status' => true
        ]);

    }

    //funcao de conversao de valores
    public function converter(Request $request){

        $usuario_id = isset($request->usuario_id) ? $request->usuario_id:null;
        $moeda_origem= $request->moeda_origem;
        $moeda_destino = $request->moeda_destino;
        $pagamento = $request->pagamento;
        $valor = $request->valor;

        //Url -> resgatar valor de conversão para calculo e URL1 -> resgata o valor da moeda de destino para informacao
        $url = "https://economia.awesomeapi.com.br/json/last/".$moeda_origem."-".$moeda_destino;
        $url1 = "https://economia.awesomeapi.com.br/json/last/".$moeda_destino."-".$moeda_origem;

        $chave = $moeda_origem.$moeda_destino;

        $response = Http::get($url)->json();
        $valor_conversao = (float) $response[$chave]['high'];

        $chave1 = $moeda_destino.$moeda_origem;
        $response1 = Http::get($url1)->json();
        $valor_moeda_destino = (float) $response1[$chave1]['high'];

        $tax = Moedas::with('taxas')->where('sigla',$moeda_destino)->first();

        $taxaBoleto = $tax->taxas->taxaBoleto/100;
        $taxaCartao = $tax->taxas->taxaCartao/100;
        $valor_controle = $tax->taxas->valor_controle;
        $max = $tax->taxas->taxaConversaoMax/100;
        $min = $tax->taxas->taxaConversaoMin/100;

        $taxaConversao = 0;
        $taxaPagamento = 0;
        $valorFinal = 0;

        if($pagamento == "BOLETO"){
            if($valor_controle < $valor){
                $taxaConversao = $valor * $min;
                $taxaPagamento = $valor * $taxaBoleto;
            }else{
                $taxaConversao = $taxaBoleto * $min;
                $taxaPagamento = $valor * $taxaBoleto;
            }
        }else{
            if($valor_controle < $valor){
                $taxaConversao =  $valor * $min;
                $taxaPagamento =  $valor * $taxaCartao;
            }else{
                $taxaConversao =  $valor * $max;
                $taxaPagamento =  $valor * $taxaCartao;
            }
        }
        $valorPagamento = $valor - $taxaConversao - $taxaPagamento;
        $destino = $valor*$valor_conversao;
        $invoice = [
                    'usuario_id'=>$usuario_id,
                    'data_cotacao'=>Carbon::now()->format('Y-m-d H:m:i'),
                    'valorEntrada'=>$valor,
                    'moeda_origem'=>$moeda_origem,
                    'formaPagamento'=>$pagamento,
                    'valor_moeda_destino'=>$valor_moeda_destino,
                    'moeda_destino'=>$moeda_destino,
                    'taxaConversao'=>$taxaConversao,
                    'taxaPagameno'=>$taxaPagamento,
                    'valorPagamento'=>$valorPagamento,
                    'valorMoedaDestino'=>$destino,
                    'statusCotacao'=>0
            ];
        if($usuario_id){
            $historico = Historico::create($invoice);

        }
        $invoice['id'] = $historico->id;
        return response([
            'cotacao' => $invoice,
            'message' => 'Invoice Gerada!',
            'status' => true
        ]);
    }
}
