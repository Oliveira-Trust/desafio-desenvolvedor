<?php

namespace App\Domains\Upload\Application\Ports;

use App\Domains\Upload\Domain\Entities\Upload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UploadRepository
{
    public function paginate(int $perPage = 10, ?string $filename = null, ?string $date = null): LengthAwarePaginator;

    public function existsByFileMd5(string $fileMd5): bool;

    public function findById(int $id): ?Upload;

    public function markAsProcessing(int $id): void;

    public function incrementProgress(int $id, int $processedRows = 0, int $failedRows = 0): void;

    public function markAsCompleted(int $id): void;

    public function markAsFailed(int $id, ?string $errorMessage = null): void;

    public function create(Upload $upload): Upload;
}
