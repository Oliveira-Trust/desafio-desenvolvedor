<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use OT\ConversorMoedas\Domain\Entity\Conversao;

class ConversaoRealizada extends Mailable
{
    use Queueable, SerializesModels;

    public array $conversao;

    public function __construct(array $conversao)
    {
        $this->conversao = $conversao;
    }

    /**
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '💰Nova conversao realizada',
        );
    }

    /**
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.conversao-realizada',
        );
    }

    /**
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
