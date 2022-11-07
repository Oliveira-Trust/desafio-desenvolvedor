<?php

namespace App\Traits;
use Exception;

trait GeneralHelper
{
    public function underscoreToCamelCase($string): String
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $str[0] = strtolower($str[0]);

        return $str;
    }

    public function sendResponse(array $values, String $message): \Illuminate\Http\JsonResponse
    {
    	$response = [
            'success' => true,
            'values'  => $values,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function sendError(String $message, int $code = 400, mixed $errors = []): \Illuminate\Http\JsonResponse
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    public function responseWithError(Exception $e, String $message): \Illuminate\Http\JsonResponse
    {
        $exceptionStatusCode = (int) $e->getCode();
        $statusCode = $exceptionStatusCode >= 100 && $exceptionStatusCode < 600? $exceptionStatusCode: 500;
        $errors = $e->getMessage();
        if (json_decode($errors)) {
            $errors = json_decode($errors);
        }
        return $this->sendError($message, $statusCode, $errors);
    }
}
