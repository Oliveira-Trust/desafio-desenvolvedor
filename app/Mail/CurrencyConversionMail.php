<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrencyConversionMail extends Mailable
{
    use Queueable, SerializesModels;
   /**
     * Create a new message instance.
     *
     * @param string $emailContent The content of the email.
     * @param string $emailSubject The subject of the email.
     * @param string $emailTo The recipient email address.
     * @param string $emailFrom The sender email address.
     * @param float $conversion_value The conversion value.
     * @param string $source_currency The source currency.
     * @param string $target_currency The target currency.
     * @param float $value_target_currency The value in the target currency.
     * @return void
     */

    public function __construct(
        $emailContent,
        $emailSubject,
        $emailTo,
        $emailFrom,
        $conversion_value,
        $source_currency,
        $target_currency,
        $value_target_currency
    ) {
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->emailTo = $emailTo;
        $this->emailFrom = $emailFrom;
        $this->conversion_value = $conversion_value;
        $this->source_currency = $source_currency;
        $this->target_currency = $target_currency;
        $this->value_target_currency = $value_target_currency;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->emailTo, 'Currency Conversion')->view(
            'emails.currencyconversionmail',
            [
                'content' => $this->emailContent, 'emailto' => $this->emailTo, 'conversion_value' => $this->conversion_value,
                'source_currency' => $this->source_currency, 'target_currency' => $this->target_currency, 'value_target_currency' => $this->value_target_currency
            ]
        )
            ->subject($this->emailSubject);
    }
}
