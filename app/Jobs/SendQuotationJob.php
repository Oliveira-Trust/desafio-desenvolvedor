<?php

namespace App\Jobs;

use App\Mail\SendQuotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQuotationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::to($this->email)
                ->send(new SendQuotation($this->quotation, $this->email, $this->name));
    }
}
