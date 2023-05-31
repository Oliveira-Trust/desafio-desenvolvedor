<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotacaoMoedaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public function __construct(
        $emailContent,
        $emailSubject,
        $emailTo,
        $emailFrom,
        $valorConversao,
        $moedaOrigem,
        $moedaDestino,
        $valorMoedaDestino,
        $descricaoMoedaOrigemDestino
    ) {
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->emailTo = $emailTo;
        $this->emailFrom = $emailFrom;
        $this->valorConversao = $valorConversao;
        $this->moedaOrigem = $moedaOrigem;
        $this->moedaDestino = $moedaDestino;
        $this->valorMoedaDestino = $valorMoedaDestino;
        $this->descricaoMoedaOrigemDestino = $descricaoMoedaOrigemDestino; 
       }


   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->emailTo, 'Cotacao de moeda')->view(
            'emails.cotacaomoeda',
            [
                'content' => $this->emailContent, 'emailto' => $this->emailTo, 'valorConversao' => $this->valorConversao,
                'moedaOrigem' => $this->moedaOrigem, 'moedaDestino' => $this->moedaDestino, 'valorMoedaDestino' => $this->valorMoedaDestino,
                'descricaoMoedaOrigemDestino' => $this->descricaoMoedaOrigemDestino, 
               
            ]
        )
            ->subject($this->emailSubject);
    } 

}
