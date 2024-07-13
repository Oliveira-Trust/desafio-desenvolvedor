<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class BuildException extends Exception
{
    protected $message;

    protected $code;

    protected mixed $transportedData;

    protected string $shortMessage;

    protected string $description;

    protected string $help;

    protected string $transportedMessage;

    protected int $httpCode;

    public function __construct(array $exception)
    {
        parent::__construct();

        $this->shortMessage = $exception['shortMessage'] ?? 'internalError';
        $this->message = $exception['message'] ?? trans('exceptions.internal_error');
        $this->description = $exception['description'] ?? '';
        $this->help = $exception['help'] ?? '';
        $this->transportedMessage = $exception['transportedMessage'] ?? '';
        $this->httpCode = $exception['httpCode'] ?? Response::HTTP_UNPROCESSABLE_ENTITY;
        $this->transportedData = $exception['transportedData'] ?? '';
        $this->code = $this->shortMessage;
    }

    public function render(): Application|Response|FoundationApplication|ResponseFactory
    {
        return response($this->getError(), $this->httpCode);
    }

    public function getShortMessage(): string
    {
        return $this->shortMessage;
    }

    public function getError(): array
    {
        return array_filter([
            'shortMessage' => $this->shortMessage,
            'message' => $this->message,
            'description' => $this->description,
            'help' => $this->help,
            'transportedMessage' => $this->transportedMessage,
            'transportedData' => $this->transportedData,
        ]);
    }
}
