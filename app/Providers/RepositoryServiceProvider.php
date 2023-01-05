<?php

namespace App\Providers;

use App\Contracts\PagamentoInterface;
use App\Contracts\TaxaInterface;
use App\Repositories\PagamentoRepository;
use App\Repositories\TaxaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PagamentoInterface::class, PagamentoRepository::class);
        $this->app->bind(TaxaInterface::class, TaxaRepository::class);
    }
}
