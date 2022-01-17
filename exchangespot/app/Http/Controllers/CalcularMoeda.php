<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
 
use App\Mail\EnviaCotacao;

use Guzzle\Http\Exception\ClientErrorResponseException;
 
use carbon\Carbon;
 
class CalcularMoeda extends Controller
{
    //
 
    public function index() {
 
     return view('currency');
    }    
 
    public function calcular(Request $request) {
         
      $amount = ($request->quantidade)?($request->quantidade):(1);
      $formaPgto = ($request->formaPgto);
      $email = ($request->email);
      $nome = ($request->nome);
      $sobrenome = ($request->sobrenome);
 
      $apikey = 'd1190408f50bf5d53689'; #apikey gratuita gerada em https://free.currencyconverterapi.com/
 
      $moedaOrigem = 'BRL';
      $moedaDestino = urlencode($request->moedaDestino);
      $query =  "{$moedaOrigem}_{$moedaDestino}";
  
      $json = file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q={$query}&compact=y&apiKey={$apikey}");
 
      $obj = json_decode($json, true);
       
      $valCambio = $obj["$query"]; 
      
      if ($formaPgto=='Boleto'){

         $taxaPgto = DB::table('forma_pgtos')->where('nome', 'Boleto')->value('taxa'); #busca taxa do boleto na tabela forma_pgtos
 
       } elseif ($formaPgto=='Cartão de crédito') {
         $taxaPgto = DB::table('forma_pgtos')->where('nome', 'Cartão de Crédito')->value('taxa'); #busca taxa do cartão de crédito na tabela forma_pgtos
       }

       $valorTaxaPgto = $amount*$taxaPgto;

      if ($amount<3000){ 
        $taxaConversao = DB::table('taxas_conversao')->where('a_partir', 1000)->value('taxa'); #busca taxa para conversões menores que 3k

      }else{
        $taxaConversao = DB::table('taxas_conversao')->where('a_partir', 3000)->value('taxa'); #busca taxa para conversões maiores que 3k
      }

      $valorTaxaConversao = $amount*$taxaConversao; #multiplica taxa de conversão X valor inserido = valor da taxa em BRL

      $totalSeraConvertido = $amount-$valorTaxaConversao-$valorTaxaPgto;

      $totalAdquirido = $totalSeraConvertido*$valCambio['val']; 
      
      $mytime = Carbon::now(); 
     

      $data = array(
         "moedaOrigem" => "BRL",
         "moedaDestino" => $moedaDestino,
         "clientePagara" => number_format($amount,2,',',''),
         "formaPgto" => "$formaPgto",
         "valorCambio" => number_format(1/$valCambio['val'], 2, ',', ''),
         "valorConvertidoReal" => number_format($totalSeraConvertido,2,',',''),
         "totalAdquirido" => number_format($totalAdquirido,2,',',''),
         "valorTaxaPgto" => number_format($valorTaxaPgto,2,',',''),
         "valorTaxaConversao" => number_format($valorTaxaConversao,2,',',''), 
         "data" => $mytime->format('d/m/Y'),
         "nomeCompleto" => "$nome $sobrenome"
     ); 
     
     Mail::to($email)
            ->send(new EnviaCotacao($data)); #envia e-mail para o usuário com todas as infos

      echo json_encode($data); die;
      
 
 
     
   }
 
}