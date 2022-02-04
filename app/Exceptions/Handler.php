<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception){
        
        // https://stackoverflow.com/questions/29892385/api-exceptions-in-laravel-5
        if($request->is('api/*')) {
    
            if($exception instanceof NotFoundHttpException) {
                return retorno(null, $exception->getStatusCode(), '', $exception->getMessage());
            }
    
            // https://stackoverflow.com/questions/38580890/how-to-return-403-response-in-json-format-in-laravel-5-2
            if($exception instanceof AuthenticationException) {
                return retorno(null, 401, '', $exception->getMessage());
            }

            if($exception instanceof BadMethodCallException) {
                return retorno(null, 400, '', $exception->getMessage());
            }
        }
        
        if($exception instanceof MethodNotAllowedHttpException) {
            return retorno(null, $exception->getStatusCode(), '', $exception->getMessage());
        }
        
        return parent::render($request, $exception);
    }
}