<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuotation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var private quotation
     */

    private $quotation;

    /**
    * @var private email user
    */

   private $email;
   
   /**
    * @var private name user
    */

   private $name;
   

   /**
    * Create a new mail instance.
    *
    * @return void
    */
   public function __construct($quotation, $email, $name)
   {
       $this->quotation    = $quotation;
       $this->email        = $email;
       $this->name         = $name;
   }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->markdown('emails.UserQuotation')
                     ->subject('Cotação Realizada')
                     ->with([
                        'quotation' => $this->quotation,
                        'name' => $this->name
                    ]);
    }
}
