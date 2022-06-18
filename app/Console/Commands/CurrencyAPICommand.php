<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Oliveiratrust\CurrencyPrice\CurrencyPriceRefreshFromAPIService;

class CurrencyAPICommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to refresh currency price from an api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyPriceRefreshFromAPIService $service)
    {
        return $service->call($this);
    }
}
