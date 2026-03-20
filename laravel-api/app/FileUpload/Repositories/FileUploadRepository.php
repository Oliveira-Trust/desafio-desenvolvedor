<?php

declare(strict_types=1);

namespace App\FileUpload\Repositories;

use App\Base\Repositories\BaseRepository;
use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Models\FileUpload;

class FileUploadRepository extends BaseRepository implements FileUploadRepositoryInterface
{
    protected string $model = FileUpload::class;
}
