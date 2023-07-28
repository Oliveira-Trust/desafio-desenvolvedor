<?php
// app/Services/EmailService.php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(string $to, string $subject, string $body): void
    {
        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
    }
}
