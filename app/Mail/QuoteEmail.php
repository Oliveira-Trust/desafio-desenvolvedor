<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $username;
    public $origin_currency;
    public $destination_currency;
    public $original_value;
    public $payment_method;
    public $conversion_details;
    public $tax;
    public $original_value_minus_tax;
    public function __construct($quote)
    {
        $this->origin_currency = $quote['origin_currency'];
        $this->destination_currency = $quote['destination_currency'];
        $this->original_value = $quote['original_value'];
        $this->payment_method = $quote['payment_method'];
        $this->conversion_details = $quote['conversion_details'];
        $this->tax = $quote['tax'];
        $this->original_value_minus_tax = $quote['original_value_minus_tax'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Quote Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.quote',
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
