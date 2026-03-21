<?php

namespace App\Domains\Upload\Infrastructure\Persistence\Eloquent;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Domain\Entities\Upload as DomainUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
            $uploads->getCollection()->map(fn(Upload $upload) => $this->toDomain($upload))
        );

        return $uploads;
    }

    public function existsByFileMd5(string $fileMd5): bool
    {
        return Upload::query()
            ->where('file_md5', $fileMd5)
            ->exists();
    }

    public function findById(int $id): ?DomainUpload
    {
        $upload = Upload::query()->find($id);

        return $upload ? $this->toDomain($upload) : null;
    }

    public function markAsProcessing(int $id): void
    {
        Upload::query()
            ->whereKey($id)
            ->update([
                'status' => Upload::STATUS_PROCESSING,
                'rows_total' => 0,
                'processed_rows' => 0,
                'failed_rows' => 0,
                'error_message' => null,
                'processed_at' => null,
            ]);
    }

    public function setRowsTotal(int $id, int $rowsTotal): void
    {
        Upload::query()
            ->whereKey($id)
            ->update([
                'rows_total' => max(0, $rowsTotal),
            ]);
    }

    public function incrementProgress(int $id, int $processedRows = 0, int $failedRows = 0): void
    {
        Upload::query()
            ->whereKey($id)
            ->update([
                'processed_rows' => DB::raw('processed_rows + ' . max(0, $processedRows)),
                'failed_rows' => DB::raw('failed_rows + ' . max(0, $failedRows)),
            ]);
    }

    public function markAsCompleted(int $id): void
    {
        Upload::query()
            ->whereKey($id)
            ->update([
                'status' => Upload::STATUS_COMPLETED,
                'error_message' => null,
                'processed_at' => now(),
            ]);
    }

    public function markAsFailed(int $id, ?string $errorMessage = null): void
    {
        Upload::query()
            ->whereKey($id)
            ->update([
                'status' => Upload::STATUS_FAILED,
                'error_message' => $errorMessage,
                'processed_at' => now(),
            ]);
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
            'rows_total' => $upload->rowsTotal,
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
            rowsTotal: (int) ($upload->rows_total ?? 0),
            processedRows: (int) ($upload->processed_rows ?? 0),
            failedRows: (int) ($upload->failed_rows ?? 0),
            errorMessage: $upload->error_message,
            createdAt: $upload->created_at,
            updatedAt: $upload->updated_at,
            processedAt: $upload->processed_at,
        );
    }
}
