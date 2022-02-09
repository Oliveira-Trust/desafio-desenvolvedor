<?php

namespace App\Http\Controllers;

use App\Mail\EmailCotacao;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

const BASE_URL = 'https://economia.awesomeapi.com.br/json/';
const URL = 'last/';
const MOEDA_PAIS = 'BRL';
const VALOR_MINIMO = 1000.00;
const VALOR_MAXIMO = 100000.00;


class ControladorCotacao extends Controller

{
    //retira os caracteres (R$ , ponto) e subtitui a virgula por ponto
    public function limpaCaracter($valor)
    {
        $valorFormatado = str_replace(',', '.', str_replace(['R$ ', '.'], '', $valor));
        return $valorFormatado;
    }

    // faz a formatação dos valores para mostrar na view BR
    public function formataValoresBr($valor){
        return number_format($valor, 2, ',', '.')  ;
    }

    // faz uso da API para obter a cotação
    public function requisicao($moedaDestino)
    {

        $endPoint = BASE_URL . URL . $moedaDestino . '-' . MOEDA_PAIS;
        $request = Http::get($endPoint);
        $response = json_decode($request->body(), true);

        return $response[ $moedaDestino . MOEDA_PAIS]['bid'];
    }

// realiza os calculos
    public function calcular(Request $request)
    {

        $boleto = 0.0145;
        $card =  0.0763;
        $id_cotacao = Hash::make(auth()->user()->email);

        // recebe os valores do formulario
        $pgto = $request->pgto;
        $moedaDestino = $request->moedaDestino;
        $valorConverter = $this->limpaCaracter($request->valorConverter);
        $taxaPgto = $pgto == 'card' ? $card : $boleto;
        $taxaConv = $valorConverter < 3000.00 ? 0.02 : 0.01;
        $cotacao = $this->requisicao($moedaDestino);

      // VALORES DE COMPRA DEVEM ESTAR ENTRE O VALOR MINIMO E MAXIMO
        if($valorConverter > VALOR_MINIMO && $valorConverter < VALOR_MAXIMO ){

              //Valor comprado em "Moeda de destino"
             $valorCompradoMoedaDestino = $valorConverter / $cotacao ;

              //taxa de pagamento
              $taxaPagamento = $valorConverter * $taxaPgto;

              //Taxa de conversão:
               $taxaConversao = $valorConverter * $taxaConv;

              //Valor utilizado para conversão descontando as taxas
             $valorTotalUsado = $valorConverter - ($taxaPagamento + $taxaConversao );

            Mail::to(auth()->user()->email)->send(new EmailCotacao($id_cotacao,MOEDA_PAIS,$moedaDestino,$valorConverter,$pgto,$cotacao,$valorCompradoMoedaDestino,$taxaPagamento,$taxaConversao,$valorTotalUsado));
            return view('home')->with([
                "hash"=>$id_cotacao,
                "moedaOrigem" => MOEDA_PAIS,
                "moedaDestino" =>$moedaDestino,
                "valorConversao" => $this->formataValoresBr($valorConverter) ,
                "formaPgto" => $pgto == 'card' ? 'Cartão de Crédito' : $pgto ,
                "valorMoedaDestino" => $this->formataValoresBr($cotacao),
                "valorComprado" => $this->formataValoresBr($valorCompradoMoedaDestino),
                "taxaPagamento" => $this->formataValoresBr($taxaPagamento),
                "taxaConversao" => $this->formataValoresBr($taxaConversao),
                "valorTotalUsado" => $this->formataValoresBr($valorTotalUsado)

            ]);


        }else{
           return  redirect()->route('home')->withErrors(['msg' => 'Valor deve ser Maior que 1.000,00 e Menor que 100.000,00']);


        }



    }
}
