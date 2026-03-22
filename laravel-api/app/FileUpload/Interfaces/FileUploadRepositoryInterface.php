<?php

declare(strict_types=1);

namespace App\FileUpload\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use App\FileUpload\Models\FileUpload;
use Illuminate\Pagination\LengthAwarePaginator;

interface FileUploadRepositoryInterface extends BaseRepositoryInterface
{
    public function findByHash(string $hash): ?FileUpload;

    public function getFilesUploads(?string $name = null, ?string $date = null): LengthAwarePaginator;
}
