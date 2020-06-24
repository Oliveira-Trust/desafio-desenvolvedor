<?php

namespace App\Response;

use Illuminate\Http\JsonResponse as JsonResponseIlluminate;

class JsonResponse extends JsonResponseIlluminate
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    /**
     * @param bool $jsonResponse
     * @param string $jsonResponse
     * @param array $jsonContent
     * @param int $httpCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function success(bool $jsonStatus, string $jsonResponse, array $jsonContent = [], int $httpCode = JsonResponse::HTTP_OK, array $headers = [])
    {
        return new JsonResponse([
            self::SUCCESS => [
                'status' => $jsonStatus,
                'message' => $jsonResponse,
                'content' => $jsonContent
            ]
        ], $httpCode, $headers);
    }

    /**
     * @param string $errorMessage
     * @param array $errorDetail
     * @param int $httpCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function error(string $errorMessage, array $errorDetail = [], int $httpCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR, array $headers = [])
    {
        return new JsonResponse([
            self::ERROR => [
                'message' => $errorMessage,
                'detail' => $errorDetail
            ]
        ], $httpCode, $headers);
    }
}
