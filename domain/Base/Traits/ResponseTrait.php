<?php

namespace Oliveiratrust\Base\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait {

    private function successResponse(array $data = []): JsonResponse
    {
        return response()->json(array_merge($data, ['success' => true]));
    }

}
