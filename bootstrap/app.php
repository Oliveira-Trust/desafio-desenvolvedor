<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Shared\Errors\ApiError;
use App\Shared\Errors\ErrorCode;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthorizationException $e, Request $request) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Forbidden.', ErrorCode::AUTH_FORBIDDEN, 403);
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Resource not found.', ErrorCode::RESOURCE_NOT_FOUND, 404);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Route not found.', ErrorCode::RESOURCE_NOT_FOUND, 404);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Method not allowed.', ErrorCode::RESOURCE_NOT_FOUND, 405);
        });

        // sempre por último
        $exceptions->render(function (Throwable $e, Request $request) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Internal server error.', ErrorCode::INTERNAL_SERVER_ERROR, 500);
        });
    })->create();
