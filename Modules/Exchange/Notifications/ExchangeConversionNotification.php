<?php

namespace Modules\Exchange\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Modules\Exchange\Entities\Exchanges;
use Modules\User\Entities\User;

class ExchangeConversionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected User $user, protected Exchanges $exchange)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Exchange Conversion')
                    ->greeting("Hello! {$this->user->name}")
                    ->line('The introduction to the notification.')
                    ->line(new HtmlString('Moeda Origem: <strong>' . $this->exchange->origin_currency->value . '</strong>'))
                    ->line(new HtmlString('Moeda Destino: <strong>' . $this->exchange->destination_currency->value . '</strong>'))
                    ->line(new HtmlString('Valor da conversão: <strong>' . formatCurrency($this->exchange->conversion_value) . '</strong>'))
                    ->line(new HtmlString('Método de pagamento: <strong>' . formatPaymentMethod($this->exchange->payment_method->value) . '</strong>'))
                    ->line(new HtmlString('Câmbio: <strong>' . formatCurrency($this->exchange->exchange) . '</strong>'))
                    ->line(new HtmlString('Taxa do pagamento: <strong>' . $this->exchange->pay_rate . ' %</strong>'))
                    ->line(new HtmlString('Taxa da conversão: <strong>' . $this->exchange->exchange_rate . ' %</strong>'))
                    ->line(new HtmlString('Valor taxa do pagamento: <strong>' . formatCurrency($this->exchange->pay_rate_value) . '</strong>'))
                    ->line(new HtmlString('Valor tava da conversão: <strong>' . formatCurrency($this->exchange->exchange_rate_value) . '</strong>'))
                    ->line(new HtmlString('Valor descontado as taxas: <strong>' . formatCurrency($this->exchange->conversion_value_with_fees) . '</strong>'))
                    ->line(new HtmlString('Valor comprado: <strong>' . formatCurrency($this->exchange->purchased_value, $this->exchange->destination_currency->value) . '</strong>'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
