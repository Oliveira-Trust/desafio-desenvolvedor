<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
