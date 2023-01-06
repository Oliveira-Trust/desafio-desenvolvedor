<?php

namespace Modules\Exchange\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Exchange\Entities\Rates;
use Modules\Exchange\Notifications\ExchangeConversionNotification;
use Modules\Exchange\Services\ExchangeConversionService;
use Modules\Exchange\Services\ExchangeService;
use Modules\User\Entities\User;

class ExchangeConversionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected string $destinationCurrency,
        protected float $conversionValue,
        protected string $paymentMethod,
        protected float $exchange,
        protected User $user,
        protected ExchangeService $exchangeService,
        protected $rates
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $exchangeConversion = new ExchangeConversionService($this->destinationCurrency, $this->conversionValue, $this->paymentMethod, $this->exchange, $this->rates);

            $exchangeConversion->execute();

            $exchage = $this->exchangeService->store($exchangeConversion->toArray());

            $this->user->notify(new ExchangeConversionNotification($this->user, $exchage));
        } catch (\Throwable $th) {
            throw new Throwable($th);
        }
    }
}
