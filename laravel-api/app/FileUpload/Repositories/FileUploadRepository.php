<?php

declare(strict_types=1);

namespace App\FileUpload\Repositories;

use App\Base\Repositories\BaseRepository;
use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Models\FileUpload;
use Illuminate\Pagination\LengthAwarePaginator;

class FileUploadRepository extends BaseRepository implements FileUploadRepositoryInterface
{
    protected string $model = FileUpload::class;

    public function verifiUploadHash(string $hash): bool
    {
        return $this->model::query()
            ->where('hash', $hash)
            ->exists();
    }

    public function getFilesUploads(?string $name = null, ?string $date = null): LengthAwarePaginator
    {
        return $this->model::query()
            ->when($name, fn ($query) => $query->where('original_name', 'like', "%{$name}%")
            )
            ->when($date, fn ($query) => $query->whereDate('reference_date', $date)
            )
            ->latest()
            ->paginate(15);
    }
}
