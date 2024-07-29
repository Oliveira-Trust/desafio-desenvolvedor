<?php 

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendConversionDetails($data)
    {
        Mail::raw(
            "Detalhes da Conversão:\n\n" .
            "Moeda de Destino: {$data['currency']}\n" .
            "Valor para Conversão: R$ {$data['amount']}\n" .
            "Valor Comprado: $ {$data['converted_amount']}\n" .
            "Taxa de Pagamento: R$ {$data['payment_fee_amount']}\n" .
            "Taxa de Conversão: R$ {$data['conversion_fee_amount']}\n" .
            "Valor Líquido: R$ {$data['net_amount']}\n",
            function ($message) {
                $message->to('recipient@example.com')
                    ->subject('Detalhes da Conversão de Moeda');
            }
        );
    }
}
