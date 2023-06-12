<?php

namespace Modules\Converter\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Converter\Entities\ConversionHistory;

class SendConversionDetailsEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $conversion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ConversionHistory $conversionHistory)
    {
        $this->conversion = $conversionHistory;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('converter::emails.conversion_details', ['conversion' => $this->conversion]);
    }
}
