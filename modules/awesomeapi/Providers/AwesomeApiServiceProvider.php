<?php

declare(strict_types=1);

namespace AwesomeApi\Providers;

use AwesomeApi\Connection\ClientJsonAdapter;
use AwesomeApi\Connection\HttpConnection;
use AwesomeApi\Tests\ServerMock\AwesomeApiMock;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AwesomeApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/awesomeApi.php');

        $this->app->bind(HttpConnection::class, ClientJsonAdapter::class);

        Http::fake(function(Request $request) {
            return (new AwesomeApiMock())->handle($request);
        });
    }
}
