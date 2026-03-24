<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RequestLoggingMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $startedAt = microtime(true);
        $requestId = $request->headers->get('X-Request-Id') ?: (string) Str::uuid();

        $request->attributes->set('request_id', $requestId);

        Log::info('api.request.started', [
            'request_id' => $requestId,
            'endpoint' => $request->path(),
            'method' => $request->method(),
            'user_id' => $request->user()?->id,
            'upload_id' => $request->attributes->get('upload_id'),
        ]);

        try {
            $response = $next($request);

            $response->headers->set('X-Request-Id', $requestId);

            $this->logFinishedRequest(
                request: $request,
                requestId: $requestId,
                startedAt: $startedAt,
                statusCode: $response->getStatusCode(),
            );

            return $response;
        } catch (Throwable $throwable) {
            $statusCode = method_exists($throwable, 'getStatusCode')
                ? $throwable->getStatusCode()
                : 500;

            $this->logFinishedRequest(
                request: $request,
                requestId: $requestId,
                startedAt: $startedAt,
                statusCode: $statusCode,
            );

            throw $throwable;
        }
    }

    private function logFinishedRequest(
        Request $request,
        string $requestId,
        float $startedAt,
        int $statusCode
    ): void {
        Log::info('api.request.finished', [
            'request_id' => $requestId,
            'endpoint' => $request->path(),
            'status_code' => $statusCode,
            'duration_ms' => (int) ((microtime(true) - $startedAt) * 1000),
            'user_id' => $request->user()?->id,
            'upload_id' => $request->attributes->get('upload_id'),
        ]);
    }
}
