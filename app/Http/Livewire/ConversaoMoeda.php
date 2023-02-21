<?php

namespace App\Http\Livewire;

use App\Mail\ConversaoRealizada;
use App\Models\Conversao;
use App\Models\FormaPagamento;
use App\Models\TaxaConversao;
use App\Models\TipoMoeda;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use OT\ConversorMoedas\Application\UseCases\Conversor\ConverterValorUC;
use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorInputDTO;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\CotacaoMoedaService;
use OT\ConversorMoedas\Infra\Repository\ConversaoEloquentRepository;
use OT\ConversorMoedas\Infra\Repository\FormaPagamentoEloquentRepository;

class ConversaoMoeda extends Component
{
    private $repositoryConversao;

    private $repositoryFormaPagamento;

    private $serviceCotacao;

    public $valorCompra = 1000;

    public $moedaDestino = 'USD';

    public $formaPagto = 'BLT';

    public $moedas = [];

    public $formasPagto = [];

    public $isConversaoRealizada = false;

    public $resultadoConversao;

    public $alert = ['tipo' => '', 'msg' => ''];

    public function __construct()
    {
        $this->repositoryConversao = new ConversaoEloquentRepository(new TipoMoeda(), new TaxaConversao(), new Conversao());
        $this->repositoryFormaPagamento = new FormaPagamentoEloquentRepository(new FormaPagamento());
        $this->serviceCotacao = new CotacaoMoedaService();
    }

    public function mount()
    {
        $moedas = $this->repositoryConversao->listAllMoedas();
        $this->moedas = $moedas->map(function ($item) {
            return ['sigla' => $item->getSigla(), 'nome' => $item->getNome()];
        })->toArray();

        $formas = $this->repositoryFormaPagamento->fetchAll();
        $this->formasPagto = $formas->map(function ($item) {
            return ['sigla' => $item->getSigla(), 'nome' => $item->getNome()];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.conversao-moeda');
    }

    public function calcular()
    {
        $this->alert = ['tipo' => '', 'msg' => ''];

        try {
            $input = new ConverterValorInputDTO('BRL', $this->moedaDestino, $this->valorCompra, $this->formaPagto);

            $uc = new ConverterValorUC($input, $this->repositoryFormaPagamento, $this->repositoryConversao, $this->serviceCotacao->cotacao());
            $output = $uc->execute();

            $this->sendEmail($output->toArray()); //MELHORIA LANÇAR EVENTO E CRIAR UM JOB PARA O ENVIO DO EMAIL
            $this->isConversaoRealizada = true;
            $this->resultadoConversao = $output->toArray();

            $this->emit('novaConversao');
        } catch (\DomainException $d) {
            $this->alert = ['tipo' => 'warning', 'msg' => 'ATENÇÃO: '.$d->getMessage()];
        } catch (\Exception $e) {
            $this->alert = ['tipo' => 'warning', 'msg' => 'ATENÇÃO: '.$e->getMessage()];
        }
    }

    public function novaConversao()
    {
        $this->valorCompra = 1000;
        $this->isConversaoRealizada = false;
        $this->resultadoConversao = null;
    }

    public function sendEmail($arrDados)
    {
        Mail::to(auth()->user())->send(new ConversaoRealizada($arrDados));
    }
}
