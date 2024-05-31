<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Interface\Currency\CurrencyServiceInterface;

class UpdateAvailableCurrencies extends Command
{
    protected $signature = 'currencies:update';

    protected $description = 'Atualiza as moedas disponíveis e armazena em cache';

    protected $currencyService;

    public function __construct(CurrencyServiceInterface $currencyService)
    {
        parent::__construct();

        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        try {
            $this->info('Buscando moedas disponíveis');

            $this->currencyService->getAvailableCurrencies();

            $this->info('Moedas disponíveis atualizadas.');

            return 0;
        } catch (\Exception $e) {
            $this->error('Ocorreu um erro ao atualizar as moedas disponíveis: ' . $e->getMessage());
            return 1;
        }
    }
}
