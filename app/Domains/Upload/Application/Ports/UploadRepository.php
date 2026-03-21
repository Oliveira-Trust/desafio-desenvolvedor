<?php

namespace App\Domains\Upload\Application\Ports;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Domains\Upload\Domain\Entities\Upload;

interface UploadRepository
{
    public function paginate(int $perPage = 10, ?string $filename = null, ?string $date = null): LengthAwarePaginator;
    public function existsByFileMd5(string $fileMd5): bool;
    public function create(Upload $upload): Upload;
}
