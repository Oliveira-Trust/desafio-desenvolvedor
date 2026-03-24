<?php

namespace App\Shared\Responses;

use Illuminate\Http\JsonResponse;

final class ApiSuccess
{
    public static function make(
        mixed $data = null,
        ?string $message = null,
        int $status = 200,
        ?array $meta = null
    ): JsonResponse {
        $payload = [
            'data' => $data,
            'meta' => $meta,
        ];

        if ($message !== null) {
            $payload['message'] = $message;
        }

        return response()->json($payload, $status);
    }
}
