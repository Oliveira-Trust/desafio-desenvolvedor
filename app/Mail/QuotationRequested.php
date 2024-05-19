<?php

namespace App\Mail;

use App\Models\Conversion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationRequested extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected Conversion $conversion
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cotação realizada com sucesso',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.conversions.requested',
            with: [
                'conversion' => $this->conversion
            ]
        );
    }
}
