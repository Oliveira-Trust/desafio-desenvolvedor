<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\ServerMock\Responses;

class BaseResponseMock
{
    protected function getJson(string $filename): array
    {
        return json_decode(file_get_contents(__DIR__ . "/../Json/{$filename}.json"), true);
    }
}
