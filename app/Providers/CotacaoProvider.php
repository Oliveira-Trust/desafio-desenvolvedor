<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CotacaoAPI;
use App\Services\AwesomeCotacaoAPI;

class CotacaoProvider extends ServiceProvider
{

    public $bindings = [
        CotacaoAPI::class => AwesomeCotacaoAPI::class
    ];

}
