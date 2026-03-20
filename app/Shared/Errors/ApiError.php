<?php

namespace App\Shared\Errors;

use Illuminate\Http\JsonResponse;

final class ApiError
{
    public static function make(
        string $message,
        string $errorCode,
        int $status,
        ?array $errors = null,
        ?string $traceId = null
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error_code' => $errorCode,
            'errors' => $errors,
            'trace_id' => $traceId,
        ], $status);
    }
}