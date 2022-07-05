<?php

namespace App\Mail;

use App\Models\UserHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExchangeCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user_history;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserHistory $user_history)
    {
        $this->user_history = $user_history;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.exchange_created', [
            'user_history' => $this->user_history
        ]);
    }
}
