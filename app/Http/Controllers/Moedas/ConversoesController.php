<?php

namespace App\Http\Controllers\Moedas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;
//Models
use App\Http\Models\FormaPagamentoTaxa;
use App\Http\Models\ConversoesMoeda;
use App\Http\Models\ConversaoTaxa;

// use PDF;

class ConversoesController extends Controller{
    protected $modulo = 'moedas';
    protected $entidade = 'conversoes_moedas';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //TODO: Inserir Try Catch
        $objConversoesMoeda =  new ConversoesMoeda();
        $condicoes = [];
        $condicoes[] = ['conversoes_moedas.empresa_id', '=', Auth::user()->empresa_id];
        if(!empty($request->query('busca_padrao'))){
            if(!empty($request->query('busca'))){
                $condicoes[] = ['conversoes_moedas.moeda_destino', 'like', '%'.$request->query('busca').'%'];
            }
        }
        if(!empty($request->query('busca_avancada'))){
            if(!empty($request->query('moeda_origem'))){
                $condicoes[] = ['conversoes_moedas.moeda_origem', 'like', '%'.$request->query('moeda_origem').'%'];
            }
            if(!empty($request->query('moeda_destino'))){
                $condicoes[] = ['conversoes_moedas.moeda_destino', 'like', '%'.$request->query('moeda_destino').'%'];
            }
        }
        $conversoesMoedas = $objConversoesMoeda->listaPaginacao($condicoes);
        unset( $objConversoesMoeda );
        return view($this->modulo.'.'.$this->entidade.'.index',compact('conversoesMoedas'))
               ->with('i', (request()->input('page', 1) - 1) * 4);
    }
    /**
     * Adicionar Forma de pagamento
     *
     * @return void
     */
    public function adicionar(){
        return view($this->modulo.'.'.$this->entidade.'.adicionar');
    }
    /**
     * Salvar a Forma de pagamento
     *
     * @param Request $request
     * @return void
     */
    public function salvar(Request $request){
        //TODO: Inserir Try Catch
        $objFormaPagamentoTaxa =  new FormaPagamentoTaxa();
        $objConversoesMoeda =  new ConversoesMoeda();
        $objConversaoTaxa =  new ConversaoTaxa();
        
        $request->offsetSet('valor_conversao', str_replace('$', '',$request->valor_conversao));
        $request->offsetSet('valor_conversao', str_replace(',', '',$request->valor_conversao));
        $request->request->add(['valor_conversao' => floatval($request->valor_conversao)]);
        $request->request->add(['moeda_origem' => 'BRL']);
        
        $request->validate([
            'moeda_destino' => ['required'],
            'valor_conversao' => ['required'],
            'forma_pagamento' => ['required'],
            'email' => ['required'],
        ]);
        
        // Buscar os dados para conversão -  exemplo final url - json/last/USD-BRL
        $retornoApiMoeda = [];
        $retornoApiMoeda = requisicao('json/last/'.$request->moeda_destino.'-BRL');
        //Buscar a taxa da forma de pagamento
        $formaPagamentoTaxa = [];
        $taxa_pagamento_porcentagem = '1.45';
        $formaPagamentoTaxa = $objFormaPagamentoTaxa->buscarPorTipo($request->forma_pagamento);
        if(!empty($formaPagamentoTaxa->porcentagem )){
            $taxa_pagamento_porcentagem = $formaPagamentoTaxa->porcentagem;
        }
        
        if($request->valor_conversao < 1000 || $request->valor_conversao > 100000){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'O valor de conversão deve ser entre R$1000,00 e R$100.000,00.',
                    ]);
        }
        //Buscar a taxa de conversão de acordo com o valor
        $conversaoTaxa = [];
        $taxa_conversao_porcentagem = '1';
        $conversaoTaxa = $objConversaoTaxa->buscarPorValor($request->valor_conversao);
        if(!empty($conversaoTaxa[0]->porcentagem )){
            $taxa_conversao_porcentagem = $conversaoTaxa[0]->porcentagem;
        }
        
        $valor_moeda_destino = 0;
        $valor_comprado_moeda_destino = 0;
        $valor_final_conversao = '0';
        if(!empty($retornoApiMoeda[$request->moeda_destino.'BRL']['bid'])){
            //Tratar valor da moeda de destino
            $valor_moeda_destino = floatval($retornoApiMoeda[$request->moeda_destino.'BRL']['bid']);
            $valor_moeda_destino = \App\Helpers\FormataHelper::formataValor(floatval($retornoApiMoeda[$request->moeda_destino.'BRL']['bid']),'2', '.','');
            
            //Taxas
            $request->request->add(['taxa_pagamento' => $request->valor_conversao / 100 * $taxa_pagamento_porcentagem]);
            $request->request->add(['taxa_conversao' => $request->valor_conversao / 100 * $taxa_conversao_porcentagem]);
            
            //Subtrair taxa de pagamento
            $valor_final_conversao = floatval($request->valor_conversao - ($request->taxa_pagamento + $request->taxa_conversao ) ) ;
            
            //Valor comprado 
            $valor_comprado_moeda_destino = \App\Helpers\FormataHelper::formataValor(ceil(floatval($valor_final_conversao) / floatval($valor_moeda_destino)),'2', '.','');
            
            //Requests tratados 
            $request->request->add(['valor_moeda_destino' => floatval($valor_moeda_destino)]);
            $request->request->add(['valor_comprado_moeda_destino' => floatval($valor_comprado_moeda_destino)]);
            $request->request->add(['valor_final_conversao' => $valor_final_conversao]);
        }else{
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Erro ao acessar API de Moedas.',
                    ]);
        }
        if(empty($request->empresa_id)){
            $request->request->add(['empresa_id' => Auth::user()->empresa_id]);
        }
        if(empty($request->id)){
            $request->request->add(['user_id' => Auth::user()->id]);
        }
        
        $conversoesMoeda = $objConversoesMoeda->salvar($request->all());
        unset($objFormaPagamentoTaxa, $objConversoesMoeda,$objConversaoTaxa);
        return redirect()->route($this->entidade.'.index', [$conversoesMoeda->id,2])
                        ->with('success','Cotação cadastrada com sucesso!');
    }
    //$conversaoMoeda = $objConversoesMoeda->buscarPorId($cotacao_id);
    /**
     * Visualizar cotacao
     */
    public function visualizar($id){
        $objConversoesMoeda =  new ConversoesMoeda();
        $conversaoMoeda = $objConversoesMoeda->buscarPorId($id);
        if(empty( $conversaoMoeda )){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        unset($objConversoesMoeda);
        return view($this->modulo.'.'.$this->entidade.'.visualizar',compact('conversaoMoeda'));
    }
    /**
     * Abrir tela de relatorio
     *
     * @param Request $request
     * @return void
     */
    public function relatorio(Request $request){
        $objConversoesMoeda =  new ConversoesMoeda();
        $conversoesMoedas = $objConversoesMoeda->buscarPorEmpresa(Auth::user()->empresa_id);
        unset($objConversoesMoeda);
        $delimitador = ","; 
        $nome_arquivo = "cotacoes_" . date('d_m_Y_H_i_s') . ".csv"; 
        $f = fopen('php://memory', 'w'); 
        $campos = [
                    'Moeda de origem', 
                    'Moeda de destino', 
                    'Forma de pagamento',
                    'Valor para conversão', 
                    'Taxa de pagamento',
                    'Taxa de conversão',
                    'Valor utilizado para conversão',
                    'Valor moeda de destino',
                    'Valor comprado'
                ]; 
        fputcsv($f, $campos, $delimitador); 
        if(!empty($conversoesMoedas)){
            foreach($conversoesMoedas as $k => $item){
                $cotacao = [];
                $cotacao = [
                    $item->moeda_origem.' - Real',
                    $item->moeda_destino.' - '.($item->moeda_destino == 'USD' ? 'Dollar Americano' : 'Euro'),
                    ($item->forma_pagamento == 'B' ? 'Boleto' : 'Cartão') ,
                    \App\Helpers\FormataHelper::formataValor($item->valor_conversao),
                    \App\Helpers\FormataHelper::formataValor($item->taxa_pagamento),
                    \App\Helpers\FormataHelper::formataValor($item->taxa_conversao),
                    \App\Helpers\FormataHelper::formataValor($item->valor_final_conversao),
                    \App\Helpers\FormataHelper::formataValor($item->valor_moeda_destino),
                    \App\Helpers\FormataHelper::formataValor($item->valor_comprado_moeda_destino)
                ];
                fputcsv($f, $cotacao, $delimitador);
            }
        }
        fseek($f, 0); 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $nome_arquivo . '";'); 
        fpassthru($f);
    }
}
