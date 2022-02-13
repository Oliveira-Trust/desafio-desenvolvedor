<?php

namespace App\Exceptions;

use Exception;

abstract class CustomRuleExceptions extends Exception
{
    protected string $description;

    protected $message;

    protected string $help;

    protected int $httpCode;

    protected string $params;

    abstract public function getHttpStatus();

    abstract public function getShortMessage();

    abstract public function getDescription();

    /** @return string[] */
    public function render()
    {
        return response(
            [
                'error' => $this->getError()
            ],
            $this->getHttpStatus()
        );
    }

    /** @return string[] */
    public function getError(): array
    {
        return [
            'shortMessage' => $this->getShortMessage(),
            'message'      => $this->getDescription(),
            'help'         => $this->getHelp(),
        ];
    }

    public function getHelp(): string
    {
        return $this->help ?? '';
    }

    public function setParams(string $params)
    {
        $this->params = $params;
    }
}
