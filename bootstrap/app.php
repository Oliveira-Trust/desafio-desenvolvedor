<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Domain\Files\Exceptions\FileAlreadyExistsException;
use Presentation\Api\V1\Middlewares\ForceJsonResponse;
use Shared\Exceptions\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            $routesFile = base_path('routes/api/v1.php');
            Route::middleware('api')
                ->prefix('v1')
                ->group($routesFile);
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [ForceJsonResponse::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (FileAlreadyExistsException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        });

        $exceptions->renderable(function (HttpException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        });
    })->create();
