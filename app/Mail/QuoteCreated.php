<?php

namespace App\Mail;

use App\Models\Currency;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Quote $quote, protected User $user, public  $currencies, public  $paymentMethods)
    {
        $this->quote->conversion_amount = Currency::format($this->quote->conversion_amount, $this->quote->currency_origin);
        $this->quote->currency_value = Currency::format($this->quote->currency_value, $this->quote->currency_origin);
        $this->quote->payment_rate = Currency::format($this->quote->payment_rate, $this->quote->currency_origin);
        $this->quote->conversion_rate = Currency::format($this->quote->conversion_rate, $this->quote->currency_origin);
        $this->quote->conversion_value = Currency::format($this->quote->conversion_value, $this->quote->currency_origin);
        $this->quote->converted_amount = Currency::format($this->quote->converted_amount, $this->quote->currency_name);
        logger('Mail', ['currencies' => $currencies]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Otação finalizada!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.quotes.created'
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
