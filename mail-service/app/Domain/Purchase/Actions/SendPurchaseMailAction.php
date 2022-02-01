<?php

namespace Domain\Purchase\Actions;

use Domain\Purchase\Mail\CreatePurchaseMail;
use Illuminate\Support\Facades\Mail;

final class SendPurchaseMailAction
{
    public function __invoke(array $mailData)
    {
        Mail::to($mailData['user']['email'])->send(new CreatePurchaseMail($mailData));
    }
}
