<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $dados)
    {
        $this->user = $user;
        $this->data = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('wasmont@mailinator.com','Washington Monteiro')
                ->subject('Conversão de Moeda') 
                ->view('emails.conversao-moeda')
                ->with([
                    'user' => $this->user,
                    'data' => $this->data,
                ]);
    }
}
