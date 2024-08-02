<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Module\Broker\Entities\Transaction;

class CurrencyConverted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly Transaction $transaction
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Currency Converted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail',
            with: [
                'name' => auth()->user()->name,
                'currency_origin' => $this->transaction->getInvoice()->currencyOrigin(),
                'currency_destination' => $this->transaction->getInvoice()->currencyDestination(),
                'amount' => number_format($this->transaction->getInvoice()->amountInCents() / 100, 2, ',', '.'),
                'rate' => number_format($this->transaction->getRateConversion() / 2, 2),
                'payment' => $this->transaction->getInvoice()->paymentMethod()->name,
                'value_of_purchased' => number_format($this->transaction->getAmountAfterApplyFees() / 100, 2, ',', '.'),
                'payment_tax' => number_format($this->transaction->getFeePaymentMethod() / 100, 2, ',', '.'),
                'conversion_tax' => number_format($this->transaction->getFeeConversion() / 100, 2, ',', '.'),
                'total_converted' => number_format($this->transaction->getPurchasedCurrencyDestination(), 2, ',', '.'),
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
