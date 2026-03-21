<?php

namespace App\Domains\Upload\Application\Services;

use App\Jobs\ProcessUploadJob;
use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Application\Ports\UploadStorage;
use App\Domains\Upload\Domain\Entities\Upload;
use App\Domains\Upload\Exceptions\DuplicateUploadException;
use Illuminate\Http\UploadedFile;

final class UploadService
{
    public function __construct(
        private readonly UploadRepository $uploads,
        private readonly UploadStorage $storage,
    ) {}

    public function uploadList(int $perPage = 10, ?string $filename = null, ?string $date = null)
    {
        return $this->uploads->paginate($perPage, $filename, $date);
    }

    public function uploadFile(UploadedFile $file): Upload
    {
        $fileMd5 = $this->calculateHash($file);

        if ($this->uploads->existsByFileMd5($fileMd5)) {
            throw new DuplicateUploadException();
        }

        $path = $this->storage->store($file, 'uploads');

        $upload = $this->uploads->create(new Upload(
            id: null,
            filename: $file->getClientOriginalName(),
            path: $path,
            mimeType: $file->getMimeType() ?? 'application/octet-stream',
            size: $file->getSize() ?? 0,
            fileMd5: $fileMd5,
            status: 'pending',
            rowsTotal: 0,
            processedRows: 0,
            failedRows: 0,
        ));

        ProcessUploadJob::dispatch($upload->id);

        return $upload;
    }

    private function calculateHash(UploadedFile $file): string
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
