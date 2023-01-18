<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Http;
use App\Models\Coin;
use Illuminate\Support\Facades\Artisan;

class InstallData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instala os dados inciais da aplicação';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('php artisan migrate');
        //dd(env('API_COINS_URL'));
        $response = Http::get(env('API_COINS_URL'));
        
        foreach(json_decode($response->body(),true) as $key => $value){

            if (str_starts_with($key, env('API_BASE_COIN') . '-')) {
                $coins = explode('-', $key);
                //dd($coins);
                Coin::create(
                    [
                        'coin_dest' => $coins[1],
                        'coin_base' => $coins[0],
                        'label' => $value,
                    ]
                );
            }

        }
        $this->info('Moedas importas e tudo pronto para inciar o sistenma');
        return Command::SUCCESS;
    }
}
