<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    private $return;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $this->gerarModelException($exception)
             ->gerarRouteException($exception)
             ->savaLog($exception);

        return !\is_null($this->return) ? $this->return : parent::render($request, $exception);
    }

    private function gerarModelException(Throwable $exception)
    {
        if (\is_null($this->return) && $exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $this->return =  response()->json(['error' => 'Não foi possível realizar o processamento da instrução informada.'], 406);
        }
        return $this;
    }

    private function gerarRouteException(Throwable $exception)
    {
        if (\is_null($this->return) && $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $this->return =  response()->json(['error' => 'O serviço solicitado não exite ou não está disponível no momento!']);
        }
        return $this;
    }

    private function savaLog(Throwable $exception)
    {
        if (\env("APP_ENV") != "production" && isset($exception->status) && $exception->status != 422) {
            \Log::debug($exception);
        }
        return $this;
    }
}
