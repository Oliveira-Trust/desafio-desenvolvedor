<?php

declare(strict_types=1);

namespace App\Exceptions\Config;

class BaseException
{
    private $type;
    private $messageForHumans;
    private $reason;
    private $support;
    private $httpCode;
    private $response;
    private $data;

    public function __construct(
        string $type,
        string $messageForHumans,
        string $reason,
        string $support,
        int $httpCode = 500,
        array $data = []
    ) {
        $this->type             = $type;
        $this->messageForHumans = $messageForHumans;
        $this->reason           = $reason;
        $this->support          = $support;
        $this->httpCode         = $httpCode;
        $this->data             = $data;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessageForHumans()
    {
        return $this->messageForHumans;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return mixed
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'messageForHumans' => $this->messageForHumans,
            'reason' => $this->reason,
            'support' => $this->support,
            'httpCode' => $this->httpCode,
            'data' => $this->data,
        ];
    }
}
