<?php

require __DIR__.'/../vendor/autoload.php';

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

// Register Service Providers...
// Por exemplo, se você tiver outros provedores de serviço personalizados,
// você pode registrá-los aqui.
// $app->register(App\Providers\OutroProvider::class);

// Registre o provedor de serviço CurrencyApiProvider:
$app->register(App\Providers\CurrencyApiProvider::class);

return $app;
