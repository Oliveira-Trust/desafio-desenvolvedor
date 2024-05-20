<?php

namespace App\Console\Commands;

use App\Models\ConversionAvailable;
use App\Models\Currency;
use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Console\Command;

class CurrenceImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa dados sobre moedas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new AwesomeApiQuotesService();
        $currencies = $service->currencies()->names();
        $availables = $service->quotes()->available();

        foreach ($currencies as $key => $value) {
            Currency::create([
                'code' => $key,
                'name' => $value
            ]);
        }

        foreach ($availables as $key => $value) {
            ConversionAvailable::create([
                'code' => $key,
                'name' => $value
            ]);
        }
    }
}
