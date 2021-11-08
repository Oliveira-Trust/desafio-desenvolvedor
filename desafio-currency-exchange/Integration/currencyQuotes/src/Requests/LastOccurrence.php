<?php

declare(strict_types=1);

namespace Integration\currencyQuotes\src\Requests;

class LastOccurrence extends BaseRequest
{
    protected $route = 'last_occurrence';

    /**
     * @param mixed[] $payload
     * @return mixed[]
     */
    public function handle(array $payload): array
    {
        $response = $this->request($payload)->execute();

        return $response->getData();

    }
}
