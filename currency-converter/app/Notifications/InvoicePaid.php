<?php

namespace App\Notifications;

use App\Models\BuyCurrencyModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $buyCurrencyModel;

    public function __construct($buyCurrencyModel)
    {
        Log::alert('conseguiu criar o registro de notificação');
        $this->buyCurrencyModel = $buyCurrencyModel;
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
        Log::alert('tentando disparar o registro para email');
        return (new MailMessage)
                    ->line('Purchase Details ' . $this->buyCurrencyModel->origin_currency . '-' . $this->buyCurrencyModel->destination_currency)
                    ->line('Payment Type: ' . $this->buyCurrencyModel->payment_type)
                    ->line('Payment Value: ' . $this->buyCurrencyModel->value)
                    ->line('Convertion Fee: ' . $this->buyCurrencyModel->convertion_fee)
                    ->line('Payment Fee: ' . $this->buyCurrencyModel->payment_fee)
                    ->line('Total Received: ' . $this->buyCurrencyModel->selling_price)
                    ->action('Notification Action', route('login'))
                    ->line('Thank you for using our application!');
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
