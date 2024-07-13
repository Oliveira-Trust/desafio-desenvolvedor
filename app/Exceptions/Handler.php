<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(static function (\Exception $exception, $request) {
            return response()->json([
                'shortMessage' => Exceptions::NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
                'description' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });

        $this->reportable(function (Throwable $e) {
        });
    }
}
