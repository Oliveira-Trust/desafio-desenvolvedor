<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subtitulo = "Olá =)";
        
        //TODO Criar util de tratamento de dados
        $conteudo = $this->user->name. ", sua cotação foi realizada com susesso, seguem os valores:<br/><br/>
                    <ul>
                      <li>Moeda de origem: ".$this->user->coin_exchange_from."</li>
                      <li>Moeda de destino: ".$this->user->coin_exchange_to."</li>
                      <li>Valor para conversão: ". number_format($this->user-> initial_conversion_value, 2, ",", ".")."</li>
                      <li>Forma de pagamento: ". number_format($this->user-> form_of_payment, 2, ",", ".")."</li>
                      <li>Valor da Moeda de destino: ".number_format($this->user->target_currency_value, 2, ",", ".")."</li>
                      <li>Valor Convertido:". number_format($this->user->target_currency_purchased, 2, ",", ".")."</li>
                      <li>Taxa de pagamento: ". number_format($this->user->payment_rate, 2, ",", ".")."</li>
                      <li>Taxa de conversão: ". number_format($this->user->conversion_rate, 2, ",", ".")."</li>
                      <li>Valor utilizado para conversão descontando as taxas: ". number_format($this->user->final_conversion_value, 2, ",", ".")."</li>
                    </ul>";
        
        return $this->subject('[Oliveira trust] - Cotação de conversão de moeda!')->view('emails.send-mail', compact('conteudo','subtitulo'));
    }
}
