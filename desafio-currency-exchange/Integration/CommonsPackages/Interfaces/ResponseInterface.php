<?php

declare(strict_types=1);

namespace Integration\CommonsPackages\Interfaces;

use Psr\Http\Message\ResponseInterface as ResponseInterfaceBase;

interface ResponseInterface
{
    public function getData();

    public function getHttpCode(): int;

    public function generateResponse(): array;

    public function getRequestUrl(): string;

    public function getRequestData(): array;

    public function build(ResponseInterfaceBase $response):ResponseInterface;

}
