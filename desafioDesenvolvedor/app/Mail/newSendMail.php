<?php

namespace App\Mail;

use App\QuotationHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class newSendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Get user
        $user = Auth::user();

        // Config send email
        $this->subject('Nova cotação feita!');
        $this->to($user->email, $user->name);

        $quote = QuotationHistory::where('id', $user->id)
                                    ->orderBy('created_at', 'DESC')
                                    ->first();

        return $this->markdown('mail.quote', [
            'quote' => $quote
        ]);
    }
}
