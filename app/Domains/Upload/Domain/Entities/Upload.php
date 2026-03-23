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
        public readonly int $rowsTotal = 0,
        public readonly int $processedRows = 0,
        public readonly int $failedRows = 0,
        public readonly ?string $referenceDate = null,
        public readonly ?string $errorMessage = null,
        public readonly mixed $createdAt = null,
        public readonly mixed $updatedAt = null,
        public readonly mixed $processedAt = null,
    ) {}
}
