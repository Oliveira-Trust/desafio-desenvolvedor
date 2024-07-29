<?php

namespace App\Mail;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use function App\Helpers\replace_dot_with_comma;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public Quotation $quotation
    )
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova cotação',
        );
    }

    public function content(): Content
    {
        Log::info('quotation content', $this->quotation->toArray());
        return new Content(
            markdown: 'emails.quotation',
            with: [
                'user' => $this->user->name,
                'quotation' => replace_dot_with_comma($this->quotation->quotation),
                'paymentTax' => replace_dot_with_comma($this->quotation->payment_tax),
                'conversionTax' => replace_dot_with_comma($this->quotation->conversion_tax),
                'conversionAmount' => replace_dot_with_comma($this->quotation->conversion_amount),
                'conversionNetAmount' => replace_dot_with_comma($this->quotation->conversion_net_amount),
                'destinationCurrencyAvailable' => replace_dot_with_comma($this->quotation->destination_currency_available)
            ]
        );
    }

    /**
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
