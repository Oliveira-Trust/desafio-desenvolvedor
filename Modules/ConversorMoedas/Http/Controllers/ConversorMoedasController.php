<?php

namespace Modules\ConversorMoedas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\ConversorMoedas\Entities\Taxas;
use Modules\ConversorMoedas\Entities\LogConversoes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use  App\Mail\SendMailUser;
use App\Models\User;

class ConversorMoedasController extends Controller
{
    const URL_BASE ='https://economia.awesomeapi.com.br/'; // API de Cotações de Moedas
    
    public function __construct(){}

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(!empty($request->all())){
            foreach($request->all() as $key => $value){
                if(empty($value))
                    abort(401);
                }
        }else
            abort(401);

        $moedas = $request->moeda_origem."-".$request->moeda_destino;
        $valorUser = (float)(str_replace(',','',$request->valor));
        $tipoPagamento = $request->forma_pgto;
        
        // Para pegar o valor da moeda pegar sempre o valor inverso ao da request
        $valorMoeda = $this->getValMoedaPais($moedas); //Ex: BRL/USD 1 real = 0.20 dóllar // USD-BRL 1 dóllar = 5.06 reais

        // URL
        $apiURL = self::URL_BASE."json/$valorMoeda"; 
        $responseBody = $this->curlRequest($apiURL);

        $convertido = "";
        if(($valorUser >= 1000 && $valorUser < 100000.00) && !empty($responseBody)){ // critério de aceitação (compra maior que R$ 1.000 e menor que R$ 100.000,00) conforme a DOC.
            $value = number_format((float)$responseBody[0]['bid'], 2, '.', ''); // Valor da Compra

            // Quando a moeda do Pais é maior a conversão operador deve ser de multiplicação Ex: dollars in reais
            // Quando a moeda do Pais é menor a conversão operador deve ser de divisão Ex: reais in dollars
            // Ou seja sempre o tratamento é exatamente o inverso nas conversões entre as moedas de paises diferentes
            switch ($moedas) {
                case 'BRL-USD':
                    $convertido = number_format((float)$valorUser/$value, 2, '.', '');   
                    break;
                case 'USD-BRL':
                    $convertido = number_format((float)$valorUser*$value, 2, '.', '');    
                    break;
                case 'BRL-EUR':
                    $convertido = number_format((float)$valorUser/$value, 2, '.', '');    
                    break;
                case 'EUR-BRL':
                    $convertido = number_format((float)$valorUser*$value, 2, '.', '');    
                    break;
                case 'USD-EUR':
                    $convertido = number_format((float)$valorUser/$value, 2, '.', '');    
                    break;
                case 'EUR-USD':
                    $convertido = number_format((float)$valorUser*$value, 2, '.', '');    
                    break;
                    
                default:
                    $convertido = 0;
                    break;
            }
            
        }
        
        $moedasSelecionadas = explode('-', $moedas);
        $convertido = !empty($convertido) ? $convertido : 0;
        $taxasConversao = $this->calcTaxas($valorUser, $tipoPagamento, $convertido);

        if(!empty($convertido) || $convertido > 0){
            $saida = [
                'Moeda de origem'=> $moedasSelecionadas[0],
                'Moeda de destino'=> $moedasSelecionadas[1],
                'Valor para conversão'=> number_format($valorUser, 2, '.', '')." ".$request->moeda_origem,
                'Forma de pagamento'=> $tipoPagamento,
                'Valor da "Moeda de destino" usado para conversão'=> number_format($value, 2, '.', ''),
                'Valor comprado em "Moeda de destino"'=> "$ ".$taxasConversao['valorConvertidoTaxas'],
                'Taxa de pagamento'=> $taxasConversao['taxaCompra'],
                'Taxa de conversão'=> $taxasConversao['taxaCompraConversao'],
                'Valor utilizado para conversão descontando as taxas'=> number_format((float)( $valorUser-$taxasConversao['taxaCompra']-$taxasConversao['taxaCompraConversao']), 2, '.', ''),
    
            ];
        } else
            $saida = [];
        
        // Gravar log - Históricos de Conversões do usuário autenticado
        $this->setLogs(request()->user()->id,$saida);

        return response()->json($saida);
    }

    /**
     * Pegar o valor da moeda em cima do que precisa ser convertido moeda
     * @param int $moedaConversao
     * @return String
     */
    public function getValMoedaPais($moedaConversao){
        switch ($moedaConversao) {
            case 'BRL-USD':
                return 'USD-BRL';  
                break;
            case 'USD-BRL':
                return 'BRL-USD';
                break;
            case 'BRL-EUR':
                return 'EUR-BRL';
                break;
            case 'EUR-BRL':
                return 'BRL-EUR';
                break;
            case 'USD-EUR':
                return 'EUR-USD';
                break;
            case 'EUR-USD':
                return 'USD-EUR';
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Calcular as taxas devidas em cima do valor da compra.
     * @param int $valorCompra, $tipoPagamento
     * @return Renderable
     */
    public function calcTaxas(Float $valorCompra, String $tipoPagamento, Float $valorConvertido) : Array
    {
        $taxaCompraPgto = 0;
        $taxaCompraConversao = 0;
        $taxaConversao = 0;
        $taxasConvertido = 0;

        $taxas = Taxas::where('tipo', $tipoPagamento)->where('ativo', '=', 1)->first();
        if(isset($taxas) && (!empty($taxas))){
            $taxaCompraPgto = (($valorCompra * (float)$taxas->valor)/100);
            $taxasConvertido = (($valorConvertido * (float)$taxas->valor)/100);
        }

        if($valorCompra < 3700.00){
            $taxaCompraConversao = ($valorCompra * 0.02);
            $taxaConversao = ($valorConvertido * 0.02);
        }else{
            $taxaCompraConversao = ($valorCompra * 0.01);
            $taxaConversao = ($valorConvertido * 0.01);
        }    

        return [
                'taxaCompra'=> number_format((float)$taxaCompraPgto, 2, '.', ''), 
                'taxaConvertido'=> number_format((float)$taxasConvertido, 2, '.', ''), 
                'taxaCompraConversao'=> number_format((float)$taxaCompraConversao, 2, '.', ''), 
                'taxaConversao'=> number_format((float)$taxaConversao, 2, '.', ''), 
                'valorConvertidoTaxas'=>number_format((float)($valorConvertido-$taxasConvertido-$taxaConversao), 2, '.', '')
        ];
    }

    /**
     * Pegar moeda de cada Pais
     * @return Array
     */
    public function getAll(){
        // URL         
        $apiURL = self::URL_BASE."xml/available/uniq"; // XML
        $responseBody = $this->curlRequest($apiURL,[],[],true);
        $xml = simplexml_load_string($responseBody[0]);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        asort($array);
        return response()->json($array);
    }

    private function curlRequest(String $apiURL="", Array $headers=[],  Array $postInput=[], Bool $xml=false) : Array {
        if(!empty($apiURL)){
            if(!empty($postInput))
                $response = Http::withHeaders($headers)->post($apiURL, $postInput);
            else
                $response = Http::withHeaders($headers)->get($apiURL);
      
            $statusCode = $response->status();
            if($xml)
                return [$response->getBody()];
            else
                return $responseBody = json_decode($response->getBody(), true);
        }
        return [];
    }

    private function setLogs(Int $id, Array $payload) : Bool {
        
        $data = [
            'user_id' => $id,
            'payload' => json_encode($payload),
        ];

        LogConversoes::create($data);
        // Envia e-mail para usuário
        $this->sendMail($id, $payload);
        return true;
    }

    private function sendMail($id,$data){

        $user = User::where('id', $id)->first();
        Mail::to($user->email)->send(new SendMailUser($user,$data));
    }
}
