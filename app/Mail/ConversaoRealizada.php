<?php

namespace App\Mail;

use App\Models\Conversao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConversaoRealizada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Conversao
     */
    public $conversao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Conversao $conversao)
    {
        $this->conversao = $conversao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.conversao');
    }
}
