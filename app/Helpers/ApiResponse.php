<?php
namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponse
{
    /**
     * Rollback the current database transaction and throw an exception.
     *
     * @param mixed $e The exception to be thrown.
     * @param string $message The error message to be included in the exception. Defaults to "Something went wrong! Process not completed".
     * @throws HttpResponseException The exception thrown.
     * @return void
     */
    public static function rollback($e, $message ="Something went wrong! Process not completed"){
        DB::rollBack();
        self::throw($e, $message);
    }

    /**
     * Throws an HttpResponseException with a JSON response containing the provided error message.
     *
     * @param mixed $e The exception to be logged.
     * @param string $message The error message to be included in the JSON response. Defaults to "Something went wrong! Process not completed".
     * @throws HttpResponseException The exception thrown.
     * @return void
     */
    public static function throw($e, $message ="Something went wrong! Process not completed", $code = 500){
        if(isset($e)){
            Log::info($e);
            $code = $e->getCode() == 0 ? $code : $e->getCode();
        }
        throw new HttpResponseException(response()->json(["message"=> $message], $code));
    }

    /**
     * Sends a JSON response with a success flag, data, and optional message.
     *
     * @param mixed $result The data to be included in the response.
     * @param string $message The optional message to be included in the response.
     * @param int $code The HTTP status code to be included in the response. Defaults to 200.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public static function sendResponse($result , $message ,$code=200){
        $response=[
            'success' => true,
            'data'    => $result
        ];

        if(!empty($message))$response['message'] =$message;

        return response()->json($response, $code);
    }
}
