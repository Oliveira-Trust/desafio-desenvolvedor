<?php

namespace App\Jobs;

use App\Mail\CotacaoMoedaMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailCotacaoMoedaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $params;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($params)
    {        
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->SendMailCotacaoMoeda($this->params);
    }


    public function SendMailCotacaoMoeda($params)
    {
        $emailContent = "Cotação de Moeda";
        $emailSubject = "Cotação de Moeda";

        Mail::to($params['emailTo'])->send(new CotacaoMoedaMail(
            $emailContent,
            $emailSubject,
            $params['emailTo'],
            $params['emailFrom'],
            $params['valorConversao'],
            $params['moedaOrigem'],
            $params['moedaDestino'],            
            $params['valorMoedaDestino'],
            $params['descricaoMoedaOrigemDestino']
        ));
    }


}
