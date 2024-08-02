<?php

namespace App\Mail;

use App\Http\Resources\CurrencyConversionResource;
use App\Models\CurrencyConversion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConversionCurrencyMarkdown extends Mailable
{
    use Queueable, SerializesModels;

    protected CurrencyConversion $currencyConversion;
    protected User $user;
    public function __construct(User $user, CurrencyConversion $currencyConversion)
    {
        $this->currencyConversion = $currencyConversion;
        $this->user = $user;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Conversão de Moeda ',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.conversion_currency',
            with: [
                'user' => $this->user,
                'currencyConversion' => new CurrencyConversionResource($this->currencyConversion),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
