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

    public function create(Upload $upload): Upload;
}
