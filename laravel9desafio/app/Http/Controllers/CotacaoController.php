<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use stdClass;

class CotacaoController extends Controller
{
    private $cotacao;

    public function __construct()
    {
        $this->cotacao = new stdClass();

        $this->cotacao->vlminCompra = 1000.00;
        $this->cotacao->vlmaxCompra = 100000.00;
        $this->cotacao->moedaOrigem = 'BRL';
        $this->cotacao->moedaDest = 'USD';
        $this->cotacao->valorConv = $this->cotacao->vlminCompra;
        $this->cotacao->formaPgto = 'B';
        $this->cotacao->vlmoedaDest = 0;
        $this->cotacao->vlcompradoDest = 0; 
        $this->cotacao->txPgto = 0.0145;
        $this->cotacao->txConv = 0.01;
        $this->cotacao->vlconvTotal = 0;
    }

    public function getCotacao()
    {
        return $this->cotacao;
    }   

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index($dados)
    {
        return view('index')->with('dados',$dados);
    }

    /**
     * 
     * @param  float  $valor
     * @param  float  $txpgto
     * @param  float  $txconv
     * @return float
     */
    public function aplicaTaxas($valor,$txPgto,$txConv)
    {
        $valorFinal = null;
        
        if (!empty($valor) && !empty($txPgto) && !empty($txConv)){
            $valortxPgto = $valor * $txPgto;
            $valortxConv = $valor * $txConv;
            $valorFinal = $valor - $valortxPgto - $valortxConv;
            $valorFinal = round($valorFinal,2);
        }
        
        return $valorFinal;
    }

    /**
     * Aplica as regras de negócio aos dados da cotação
     * 
     * @param  obj  $cotacao
     * @param  obj  $dadosapi
     *
     * @return 
     */
    public function verificaCotacao($cotacao)
    {   
        $moeda = $cotacao->moedaDest.'-'.$cotacao->moedaOrigem;
        $moedaIdx = $cotacao->moedaDest.''.$cotacao->moedaOrigem;

        $api = new ApiController();
        $dadosApi = $api->getValorCotacao($cotacao->moedaDest,$cotacao->moedaOrigem);

        $cotacao->vlmoedaDest = round($dadosApi->vlCompra,2);

        $cotacao->txPgto = ($cotacao->formaPgto == "C") ? 0.0763 : 0.0145;
        $cotacao->txConv = ($cotacao->valorConv < 3000) ? 0.02 : 0.01; // incluído o valor 3000 para taxas de 0.01, pois no texto da regra original ele não estaria incluído em nenhuma taxa.

        $vlResultConv = $cotacao->valorConv / $cotacao->vlmoedaDest;
        $vlResultConv = round($vlResultConv, 2); 

        $cotacao->vlcompradoDest = $this->aplicaTaxas($vlResultConv,$cotacao->txPgto,$cotacao->txConv);
        $cotacao->vlconvTotal = $this->aplicaTaxas($cotacao->valorConv,$cotacao->txPgto,$cotacao->txConv);

        return $cotacao;
    }

    /**
     * Traz os dados da tela e processa para salvar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salvaConversao(Request $request)
    {
        $cotacao = $this->getCotacao();

        if (empty($request->input('moedaOrigem')) or empty($request->input('moedaDestino')) 
            or (empty($request->input('valorConversao')) 
                or ($request->input('valorConversao') >= $cotacao->vlmaxCompra)
                or ($request->input('valorConversao') <= $cotacao->vlminCompra)) 
            or empty($request->input('formaPag'))){

            return response('Informe todos os valores corretamente!', 406)->header('Content-Type', 'text/plain');
        }       

        $cotacao->moedaOrigem = $request->input('moedaOrigem');
        $cotacao->moedaDest = $request->input('moedaDestino');
        $cotacao->valorConv = (float) $request->input('valorConversao');
        
        $cotacao->formaPgto = ($request->input('formaPag') == 'C') ? 'Cartão de Crédito' : 'Boleto';

        $cotacao = $this->verificaCotacao($cotacao);
        $cotacao->vltxPgto = $cotacao->txPgto * $cotacao->valorConv;
        $cotacao->vltxPgto = number_format($cotacao->vltxPgto, 2 , ",", ".");
        $cotacao->vltxConv = $cotacao->txConv * $cotacao->valorConv;
        $cotacao->vltxConv = number_format($cotacao->vltxConv, 2 , ",", ".");

        $cotacao->valorConv = number_format($cotacao->valorConv, 2 , ",", ".");
        $cotacao->vlcompradoDest = number_format($cotacao->vlcompradoDest, 2 , ",", ".");
        $cotacao->vlmoedaDest = number_format($cotacao->vlmoedaDest, 2 , ",", ".");
        $cotacao->vlconvTotal = number_format($cotacao->vlconvTotal, 2 , ",", ".");
                
        if (empty($cotacao->vlcompradoDest) or empty($cotacao->vlconvTotal)){
            return response('Erro na conversão!', 502)
                ->header('Content-Type', 'text/html');
        }

        //return redirect()->route('index', [$cotacao]);
        return view('index')->with('cotacao',$cotacao);
        /*
                    response('Cotação realizada com sucesso!', 200)
                    ->header('Content-Type', 'text/plain'); */
    } 
}
