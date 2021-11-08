<?php

declare(strict_types=1);

namespace App\Exceptions\Config;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class BuildExceptions extends \Exception
{
    protected $exception;
    protected $message;
    protected $data;

    public function __construct(BaseException $exception)
    {
        $this->exception = $exception;
        $this->message   = $exception->getReason();
        $this->code      = $exception->getHttpCode();
        parent::__construct();
    }

    public function render(): JsonResponse
    {
        return Response::json($this->exception->toArray(), $this->exception->getHttpCode() ?? 500);
    }

    public function getBaseException(): BaseException
    {
        return $this->exception;
    }
}

