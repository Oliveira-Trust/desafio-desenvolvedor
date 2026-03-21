<?php

namespace App\Domains\Upload\Application\Services;

use App\Domains\Upload\Exceptions\DuplicateUploadException;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use Illuminate\Http\UploadedFile;

final class UploadService
{
    public function uploadList(int $perPage = 10)
    {
        return Upload::query()
            ->select([
                'id',
                'filename',
                'path',
                'mime_type',
                'size',
                'status',
                'created_at',
                'updated_at',
                'processed_at',
            ])
            ->latest('created_at')
            ->paginate($perPage);
    }

    public function fileExists(string $fileMd5): bool
    {
        return Upload::query()
            ->where('file_md5', $fileMd5)
            ->exists();
    }

    public function uploadFile(UploadedFile $file): Upload
    {
        $fileMd5 = $this->calculateHash($file);

        if ($this->fileExists($fileMd5)) {
            throw new DuplicateUploadException();
        }

        $path = $file->store('uploads');

        return Upload::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
            'size' => $file->getSize(),
            'file_md5' => $fileMd5,
            'status' => Upload::STATUS_PENDING,
        ]);
    }


    public function calculateHash(UploadedFile $file): string
    {
        $filePath = $file->getRealPath();

        if ($filePath === false) {
            throw new \RuntimeException('Não foi possível acessar o arquivo enviado.');
        }

        $fileMd5 = md5_file($filePath);

        if ($fileMd5 === false) {
            throw new \RuntimeException('Não foi possível calcular o hash do arquivo.');
        }

        return $fileMd5;
    }
}
