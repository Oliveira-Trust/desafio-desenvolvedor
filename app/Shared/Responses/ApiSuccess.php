<?php

namespace App\Shared\Responses;

use Illuminate\Http\JsonResponse;

final class ApiSuccess
{
    public static function make(
        mixed $data = null,
        string $message = 'Success.',
        int $status = 200,
        ?array $meta = null
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ], $status);
    }
}