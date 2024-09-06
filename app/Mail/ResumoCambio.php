<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResumoCambio extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;

    }

    public function build()
    {
        $data = $this->data;
        return $this->view('emails.resumo-cambio', compact('data'))->with(['user' => $this->user])->subject('Resumo da operação');
    }

}
