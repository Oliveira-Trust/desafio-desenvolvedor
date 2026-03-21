<?php

declare(strict_types=1);

namespace App\FileUpload\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface FileUploadRepositoryInterface extends BaseRepositoryInterface
{
    public function verifiUploadHash(string $hash): bool;

    public function getFilesUploads(?string $name = null, ?string $date = null): LengthAwarePaginator;
}
