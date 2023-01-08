<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * @param     $data
     * @param int $statusCode
     *
     * @return mixed
     */
    public function successResponse($data, $statusCode = Response::HTTP_OK)
    {
        return response($data, $statusCode)->header('Content-Type', 'application/json');
    }

    /**
     * @param $errorMessage
     * @param $statusCode
     *
     * @return mixed
     */
    public function errorResponse($errorMessage, $statusCode)
    {
        return response()->json(['error' => $errorMessage, 'error_code' => $statusCode], $statusCode);
    }

    /**
     * @param $errorMessage
     * @param $statusCode
     *
     * @return mixed
     */
    public function errorMessage($errorMessage, $statusCode)
    {
        return response($errorMessage, $statusCode)->header('Content-Type', 'application/json');
    }

    public function makeResponse(\GuzzleHttp\Psr7\Response $response){
        return $this->successResponse($response->getBody()->getContents(), $response->getStatusCode());
    }
}
