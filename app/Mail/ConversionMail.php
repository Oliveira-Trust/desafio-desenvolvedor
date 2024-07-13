<?php

declare(strict_types=1);

namespace App\Mail;

use App\Facades\Excel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConversionMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly array $conversion,
        private readonly User  $user,
        private readonly string $fileName
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@system.com', 'Currency Converter'),
            subject: 'Currency converter quotation.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $originCurrency = $this->conversion['origin_currency'] ?? '#';
        $destinyCurrency = $this->conversion['destiny_currency'] ?? '#';

        return new Content(
            markdown: 'emails.conversion',
            with: [
                'quotationName' => "{$originCurrency}-{$destinyCurrency}",
                'userName' => $this->user->name ?? 'User...'
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        Excel::csv(data: [
            'columns' => $this->csvColumns(),
            'rows' => [$this->conversion]
        ], fileName: $this->fileName);

        return [
            Attachment::fromStorage("exports/{$this->fileName}")->withMime('text/csv')
        ];
    }

    private function csvColumns(): array
    {
        $columns = [];

        foreach ($this->conversion as $field => $value) {
            $columns[] = __(key: 'messages.' . $field, locale: 'pt_BR');
        }

        return $columns;
    }
}
