<?php

namespace App\Instrument\Providers;

use App\Instrument\Interfaces\InstrumentRepositoryInterface;
use App\Instrument\Repositories\InstrumentRepository;
use Illuminate\Support\ServiceProvider;

class InstrumentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(InstrumentRepositoryInterface::class, InstrumentRepository::class);
    }
}
