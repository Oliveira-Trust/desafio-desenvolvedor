<?php

namespace CurrencyConverter\Application\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package CurrencyConverter\Domain\Currency\Services
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        \CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface::class => \CurrencyConverter\Infrastructure\CurrencyRepository::class
    ];
}
