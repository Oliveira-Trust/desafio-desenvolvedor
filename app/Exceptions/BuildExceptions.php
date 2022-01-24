<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HttpResponse;

class BuildExceptions extends \Exception
{
    protected $message;
    protected string $shortMessage;
    protected int $httpCode;

    /** @param mixed[] $attributes */
    public function __construct(array $attributes)
    {
        $this->message = data_get($attributes, 'message', '');
        $this->shortMessage = data_get($attributes, 'shortMessage', '');
        $this->httpCode = (int) data_get($attributes, 'httpCode', Response::HTTP_UNPROCESSABLE_ENTITY);

        parent::__construct();
    }

    public function render(): HttpResponse
    {
        return response($this->getError(), $this->httpCode);
    }

    /** @return string[] */
    public function getError(): array
    {
        return [
            'message' => $this->message,
            'shortMessage' => $this->shortMessage,
        ];
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getShortMessage(): string
    {
        return $this->shortMessage;
    }
}