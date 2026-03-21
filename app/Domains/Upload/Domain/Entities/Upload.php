<?php

namespace App\Domains\Upload\Domain\Entities;

final class Upload
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $filename,
        public readonly string $path,
        public readonly string $mimeType,
        public readonly int $size,
        public readonly string $fileMd5,
        public readonly string $status,
        public readonly mixed $createdAt = null,
        public readonly mixed $updatedAt = null,
        public readonly mixed $processedAt = null,
    ) {}
}