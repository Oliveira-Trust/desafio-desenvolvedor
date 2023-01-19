<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoinAskMail extends Mailable
{
    use Queueable, SerializesModels;


    private $data;
    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
{
    return $this
    
    ->markdown('coin-ask.asked',['coinAsk'=> $this->data]);
}
}
