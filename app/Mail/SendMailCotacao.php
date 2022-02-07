<?php

namespace App\Mail;

use App\Models\Cotacao;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailCotacao extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cotacao;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Cotacao $cotacao)
    {
        $this->user = $user;
        $this->cotacao = $cotacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Solicitação de Cotação')
            ->from('teste@mail.com')
            ->with([
                'user' => $this->user,
                'cotacao' => $this->cotacao
            ])
            ->view('mail.cotacao');
    }
}
