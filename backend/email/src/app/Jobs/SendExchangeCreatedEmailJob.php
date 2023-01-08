<?php

namespace App\Jobs;

use App\Mail\ExchangeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendExchangeCreatedEmailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public function __construct(
//                public string $to,
//                public string $destination_currency_code,
//                public string $origin_currency_code,
//                public string $payment_method_name,
//                public float $origin_value,
//                public float $origin_value_without_fees,
//                public float $purchased_value,
//                public float $destination_exchange_rate,
//                public float $payment_method_fee_value,
//                public float $exchange_fee_value,
//    )
//    {
//    }
    public function __construct(public array $data, public string $to,) { }

    public function handle() {
        \Mail::to($this->to)->send(new ExchangeMail($this->data));
    }
}
