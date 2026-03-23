<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Shared\Errors\ApiError;
use App\Shared\Errors\ErrorCode;
use App\Shared\Errors\DomainException;
use App\Http\Middleware\RequestLoggingMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
        $middleware->api(append: [
            RequestLoggingMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $resolveTraceId = static function (Request $request): string {
            return $request->attributes->get('request_id')
                ?: $request->headers->get('X-Request-Id')
                ?: (string) Str::uuid();
        };

        $exceptions->render(function (ValidationException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make(
                'Validation failed.',
                ErrorCode::VALIDATION_ERROR,
                422,
                $e->errors(),
                $resolveTraceId($request)
            );
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Unauthenticated.', ErrorCode::AUTH_UNAUTHENTICATED, 401, null, $resolveTraceId($request));
        });

        $exceptions->render(function (AuthorizationException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Forbidden.', ErrorCode::AUTH_FORBIDDEN, 403, null, $resolveTraceId($request));
        });

        $exceptions->render(function (DomainException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make(
                $e->getMessage(),
                $e->errorCode,
                $e->httpStatus,
                $e->contextErrors,
                $resolveTraceId($request)
            );
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Resource not found.', ErrorCode::RESOURCE_NOT_FOUND, 404, null, $resolveTraceId($request));
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Route not found.', ErrorCode::RESOURCE_NOT_FOUND, 404, null, $resolveTraceId($request));
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Method not allowed.', ErrorCode::RESOURCE_NOT_FOUND, 405, null, $resolveTraceId($request));
        });

        $exceptions->render(function (TooManyRequestsHttpException $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Too many requests.', ErrorCode::RATE_LIMITED, 429, null, $resolveTraceId($request));
        });

        // sempre por último
        $exceptions->render(function (Throwable $e, Request $request) use ($resolveTraceId) {
            if (! $request->expectsJson() && ! $request->is('api/*')) return null;
            return ApiError::make('Internal server error.', ErrorCode::INTERNAL_SERVER_ERROR, 500, null, $resolveTraceId($request));
        });
    })->create();
