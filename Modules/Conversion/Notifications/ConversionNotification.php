<?php

namespace Modules\Conversion\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Modules\Conversion\Models\Conversion;

class ConversionNotification extends Notification implements ShouldQueue {

	use Queueable;

    public Conversion $conversion;

    public function __construct(Conversion $conversion)
	{
        $this->conversion = $conversion;
    }

	public function via($notifiable): array {
		return ['mail'];
	}

	public function toMail($notifiable): MailMessage {

		return (new MailMessage)
            ->subject('Notificação de Conversão')
			->line('Você tem uma nova conversão de moeda.')
            ->line(new HtmlString(view('conversion::conversion.partials.conversion',['conversion' => $this->conversion])->render()))
			->line('Obrigado por usar nossa aplicação!');
	}

	public function toArray($notifiable): array {
		return [];
	}
}
