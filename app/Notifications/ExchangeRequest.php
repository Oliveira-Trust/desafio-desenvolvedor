<?php

namespace App\Notifications;

use App\Models\Currency;
use App\Models\Exchange;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExchangeRequest extends Notification
{
    use Queueable;
    private $exchange;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(int $exchange_id)
    {
        $this->exchange = Exchange::find($exchange_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $defaultCurrency = Currency::getDefaultCurrency();
        $default_isocode = $defaultCurrency->isocode;
        return (new MailMessage)
                    ->line('Olá '.$notifiable->name.'!')
                    ->line(' ')
                    ->line('Aqui estão os detalhes da sua cotação:')
                    ->line(' ')
                    ->line('Moeda de origem: '.$default_isocode)
                    ->line('Moeda de destino: '.$this->exchange->currency->isocode)
                    ->line('Valor para conversão: '.$this->exchange->ask.' '.$default_isocode)
                    ->line('Forma de pagamento: '.$this->exchange->payment->name)
                    ->line('Cotação ('.$this->exchange->currency->isocode.'): '.$this->exchange->rate.' '.$default_isocode)
                    ->line('Valor comprado: '.$this->exchange->amount.' '.$this->exchange->currency->isocode)
                    ->line('Taxa de pagamento: '.$this->exchange->total_payment_tax.' '.$default_isocode)
                    ->line('Taxa de conversão: '.$this->exchange->total_exchange_tax.' '.$default_isocode)                 
                    ->line('Valor utilizado para conversão descontando as taxas: '.$this->exchange->ask_amount.' '.$default_isocode)
                    ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
