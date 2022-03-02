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
use PHPMailer\PHPMailer\PHPMailer;

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

        $cotacao_preco = CotacaoPreco::create([
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

        $this->sendEmail(Auth::user()->name, Auth::user()->email, $cotacao_preco);

        return redirect()->route('cotacao-preco.index')->with('success', 'Dados inseridos com sucesso!');
    }

    private function sendEmail($nome, $email, $cotacao_preco)
    {

        $nome_pessoa_mail = $nome;
        $email_user_mail = $email;

        $corpo  = view('cotacao-preco-email', ['cotacao_preco' => $cotacao_preco]);
        $titulo = "[ COTAÇÃO ]";

        $sender = 'Desafio Desenvolvendor';

        $mail   = new PHPMailer(true);
        try {
            $mail->isSMTP();          // Set mailer to use SMTP
            $mail->Host = '';         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;   // Enable SMTP authentication
            $mail->Username = '';     // SMTP username
            $mail->Password = '';     // SMTP password
            $mail->SMTPSecure = '';   // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 1025; //587 // TCP port to connect to

            $mail->SetFrom('noreply@rmwebsoftware.com', $sender);
            $mail->Sender = 'noreply@rmwebsoftware.com';
            $mail->addAddress($email_user_mail, $nome_pessoa_mail); // Add a recipient

            $mail->isHTML(true);
            // Set email format to HTML

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->Subject = utf8_decode($titulo);
            $mail->Body    = utf8_decode($corpo);

            $mail->Send();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'E-mail não enviado, verificar configuração');
        }
    }
}
