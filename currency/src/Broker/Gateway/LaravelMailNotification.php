<?php

declare(strict_types=1);

namespace Module\Broker\Gateway;

use App\Mail\CurrencyConverted;
use Illuminate\Support\Facades\Mail;
use Module\Broker\Entities\Transaction;

class LaravelMailNotification implements NotificationInterface
{
    public function send(Transaction $transaction): void
    {
        Mail::to(auth()->user())->send(new CurrencyConverted($transaction));
    }
}
