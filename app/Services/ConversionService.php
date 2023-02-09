<?php


namespace App\Services;

use GuzzleHttp\Client;
use App\Services\SendEmailService;
use App\Services\ConversionHistoryService;

class ConversionService
{

    /**
     * @var SendEmailService
     */
    protected $sendEmailService;

    /**
     * @var ConversionHistoryService
     */
    protected $conversionHistoryService;


    public function __construct(
        SendEmailService $sendEmailService,
        ConversionHistoryService $conversionHistoryService
    ) {
        $this->sendEmailService = $sendEmailService;
        $this->conversionHistoryService = $conversionHistoryService;
    }

    /**
     * Método que converte a moeda
     * 
     * @param array $data Dados da conversão
     * @return array|string Resultado da conversão ou mensagem de erro
     */
    public function convert($data)
    {

        // Recupera os dados de entrada
        $iconType = $data['type'];
        $paymentMethod = $data['paymentMethod'];
        $purchaseAmount = $data['purchaseAmount'];
        $nameUser = $data['nameUser'];
        $emailUser = $data['emailUser'];
        $userId = $data['userId'];

        // Instancia o cliente da API
        $client = new Client();

        // Recupera os dados de conversão
        $response = $client->get('https://economia.awesomeapi.com.br/all/' . $iconType);
        $data = json_decode($response->getBody(), true);

        // Inicializa as variáveis
        $purchaseCurrency = '';
        $rate = 0;

        // Percorre os dados de conversão
        foreach ($data as $item) {
            $purchaseCurrency = $item['code'];
            $rate = $item['high'];
        }

        // Verifica se a moeda de origem é BRL
        if ($purchaseCurrency === 'BRL') {
            return [
                'error' => 'A moeda de origem deve ser diferente do BRL.'
            ];
        }

        // Converte o valor da compra para float
        $amount = floatval($purchaseAmount);

        // Inicializa as variáveis de taxa
        $fee = 0;

        // Verifica o método de pagamento e calcula a taxa
        if ($paymentMethod && $paymentMethod == 'bank_slip') {
            $fee = $amount * 0.0145;
        } else if ($paymentMethod && $paymentMethod == 'credit_card') {
            $fee = $amount * 0.0763;
        } else {
            return 'Selecione o metodod de pagamento';
        }

        // Inicializa as variáveis de taxa de conversão
        $conversionFee = 0;
        $conversionRate = 0.02;

        // Verifica se o valor da compra é menor que 3000 e calcula a taxa de conversão
        if ($amount < 3000) {
            $conversionFee = $amount * $conversionRate;
        } else {
            $conversionFee = $amount * ($conversionRate - 0.01);
        }

        // Calcula o custo total
        $totalCost = $amount - ($fee + $conversionFee);

        // Converte o valor da compra para dólares
        $amountInDollars = $totalCost / $rate;

        // Configura a zona de tempo para São Paulo
        date_default_timezone_set('America/Sao_Paulo');
        // Recupera a data e hora atual
        $currentDateTime = date("d/m/Y H:i:s");

        // Cria messagem do corpo do email
        $dataSendEmail = $this->createMessageEmail($currentDateTime, $purchaseCurrency, $paymentMethod, $amount, $rate, $amountInDollars, $fee, $conversionFee, $totalCost, $nameUser, $emailUser);

        // Envia o email
        $responseSendEmail = $this->sendEmailService->sendEmail($dataSendEmail);

        // Cria array para salvar dados
        $arrayDataConversion = [
            'origin_currency' => 'BRL',
            'destination_currency' => $purchaseCurrency,
            'value_conversation' => $amount,
            'form_payment' => $paymentMethod == 'bank_slip' ? 'Boleto' : 'Cartão de Credito',
            'dest_currency_conv' => $rate,
            'purchased_amount_in' => $amountInDollars,
            'pay_rate' => $fee,
            'conversion_rate' => $conversionFee,
            'amount_used_conv' => $totalCost,
            'user_id' => $userId,
        ];

        //Salva dados de conversão na tabela conversions history
        $conversionHistory = $this->conversionHistoryService->store($arrayDataConversion);

        //Verifica se o email foi enviado e os dados de conversão salvos, caso seja verdadeiro retorna o array com os dados de conversão 
        if ($responseSendEmail && $conversionHistory) {
            return $arrayDataConversion;
        } else {
            //retorna erro
            return [
                'error' => 'Desculpe, as informações de cotação solicitadas não estão disponíveis no momento.'
            ];
        }
    }



    /**
     * Gera uma mensagem para o conteúdo do e-mail
     * @param mixed
     * @return array
     */
    public function createMessageEmail($currentDateTime, $purchaseCurrency, $paymentMethod, $amount, $rate, $amountInDollars, $fee, $conversionFee, $totalCost, $nameUser, $emailUser)
    {

        return [
            'message' => "Sua cotação criada em " . $currentDateTime . "<br><br>Moeda de origem: BRL<br>Moeda de origem: " . $purchaseCurrency . "<br>Valor para conversão: " . $amount . "<br>Forma de pagamento: " . $paymentMethod . "<br>Valor da 'Moeda de destino' usado para conversão: " . $rate . "<br>Valor comprado em 'Moeda de destino':  " . $amountInDollars . "<br>Taxa de pagamento: " . $fee . "<br>Taxa de conversão: " . $conversionFee . "<br>Valor utilizado para conversão descontando as taxas: " . $totalCost . "<br>",
            'name' => $nameUser,
            'email' => $emailUser,
            'subjectMatter' => 'Dados Cotação',
            'titleSenderEmail' => 'Desafio Dev(Paulo Renato) - Oliveira Trust',
        ];
    }
}
