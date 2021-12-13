<?php

namespace App\Mail;

use App\Models\CurrencyExchangeLogs;
use App\Models\User;
use App\Modules\CurrencyExchange\Module as CurrencyExchange;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrencyExchangeMail extends Mailable
{
    use Queueable, SerializesModels;

    private CurrencyExchangeLogs $currencyExchangeLogs;
    private User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CurrencyExchangeLogs $currencyExchangeLogs, User $user)
    {
        $this->currencyExchangeLogs = $currencyExchangeLogs;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Resultado da conversão de moedas')
            ->markdown('emails.currency_exchange.convert')
            ->with('currencyExchangeLogs', $this->currencyExchangeLogs)
            ->with('user', $this->user);
    }
}
