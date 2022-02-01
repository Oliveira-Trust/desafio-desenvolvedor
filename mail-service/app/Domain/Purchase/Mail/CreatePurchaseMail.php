<?php

namespace Domain\Purchase\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatePurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    protected array $purchase;

    public function __construct(array $purchaseData)
    {
        $this->purchase = $purchaseData;
    }

    public function build()
    {
        $this->view('emails.purchase')->with([
            'origin' => $this->purchase['origin'],
            'destiny' => $this->purchase['destiny'],
            'user' => $this->purchase['user'],
            'purchase_value' => $this->purchase['purchase_value'],
            'payment_method' => $this->purchase['payment_method']['display_name'],
        ]);
    }
}
