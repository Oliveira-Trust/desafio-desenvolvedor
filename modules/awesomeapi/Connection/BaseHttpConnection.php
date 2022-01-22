<?php

declare(strict_types=1);

namespace AwesomeApi\Connection;

abstract class BaseHttpConnection
{
    protected function getBaseUrl(): string
    {
        return config('awesomeapi.basePath');
    }
}
