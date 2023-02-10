<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Http\Request;



class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    //private $user;
    private $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request;
        $this->subject("Notificação sobre cotação");
        $this->to($this->request->user()->email, $this->request->user()->name);
        return $this->markdown('mail.sendMailUser', compact('data'));
        
    }
}
