<?php

namespace App\Domains\Upload\Infrastructure\Persistence\Eloquent;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Domain\Entities\Upload as DomainUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class EloquentUploadRepository implements UploadRepository
{
    public function paginate(int $perPage = 10, ?string $filename = null, ?string $date = null): LengthAwarePaginator
    {
        $query = Upload::query()->latest('created_at');

        if ($filename !== null) {
            $query->where('filename', 'like', '%' . $filename . '%');
        }

        if ($date !== null) {
            $query->whereDate('created_at', $date);
        }

        $uploads = $query->paginate($perPage);

        $uploads->setCollection(
            $uploads->getCollection()->map(fn (Upload $upload) => $this->toDomain($upload))
        );

        return $uploads;
    }

    public function existsByFileMd5(string $fileMd5): bool
    {
        return Upload::query()
            ->where('file_md5', $fileMd5)
            ->exists();
    }

    public function create(DomainUpload $upload): DomainUpload
    {
        $record = Upload::query()->create([
            'filename' => $upload->filename,
            'path' => $upload->path,
            'mime_type' => $upload->mimeType,
            'size' => $upload->size,
            'file_md5' => $upload->fileMd5,
            'status' => $upload->status,
        ]);

        return $this->toDomain($record);
    }

    private function toDomain(Upload $upload): DomainUpload
    {
        return new DomainUpload(
            id: (int) $upload->id,
            filename: (string) $upload->filename,
            path: (string) $upload->path,
            mimeType: (string) $upload->mime_type,
            size: (int) $upload->size,
            fileMd5: (string) $upload->file_md5,
            status: (string) $upload->status,
            createdAt: $upload->created_at,
            updatedAt: $upload->updated_at,
            processedAt: $upload->processed_at,
        );
    }
}
