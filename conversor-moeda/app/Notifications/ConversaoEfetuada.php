<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConversaoEfetuada extends Notification
{
    use Queueable;

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Conversão de Valores Realizada com Sucesso')
            ->greeting('Olá!')
            ->line('A conversão de valores foi realizada com sucesso. Aqui estão os detalhes:')
            ->line('Moeda de Origem: ' . $this->details->moeda_origem)
            ->line('Moeda de Destino: ' . $this->details->moeda_destino)
            ->line('Valor para Conversão: ' . $this->details->valor_para_conversao)
            ->line('Forma de Pagamento: ' . $this->details->forma_pagamento)
            ->line('Valor da Moeda de Destino: ' . $this->details->bid_destino)
            ->line('Valor Comprado: ' . $this->details->valor_comprado)
            ->line('Taxa de Pagamento: ' . $this->details->taxa_pagamento)
            ->line('Taxa de Conversão: ' . $this->details->taxa_conversao)
            ->line('Valor Utilizado para Conversão: ' . $this->details->valor_utilizado_para_conversao)
            ->line('Obrigado por usar nosso serviço!');
    }

    public function toArray($notifiable)
    {
        return [
            'moeda_origem' => $this->details->moeda_origem,
            'moeda_destino' => $this->details->moeda_destino,
            'valor_para_conversao' => $this->details->valor_para_conversao,
            'forma_pagamento' => $this->details->forma_pagamento,
            'bid_destino' => $this->details->bid_destino,
            'valor_comprado' => $this->details->valor_comprado,
            'taxa_pagamento' => $this->details->taxa_pagamento,
            'taxa_conversao' => $this->details->taxa_conversao,
            'valor_utilizado_para_conversao' => $this->details->valor_utilizado_para_conversao,
        ];
    }
}
