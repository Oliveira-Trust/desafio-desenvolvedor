<?php

declare(strict_types=1);

namespace Integration\CommonsPackages\Interfaces;

interface RequestInterface
{
    public function get(string $url): RequestInterface;

    public function execute(): ResponseInterface;

    public function getUrl(): string;

    public function getData(): array;
}
