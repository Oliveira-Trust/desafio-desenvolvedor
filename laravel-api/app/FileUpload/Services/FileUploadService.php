<?php

declare(strict_types=1);

namespace App\FileUpload\Services;

use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Models\FileUpload;
use App\Instrument\Jobs\ProcessInstrumentFileJob;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class FileUploadService
{
    public function __construct(
        private readonly FileUploadRepositoryInterface $fileUploadRepository
    ) {}

    public function handle(UploadedFile $file): FileUpload
    {
        $hash = hash_file('sha256', $file->getRealPath());

        if ($this->fileUploadRepository->verifiUploadHash($hash)) {
            throw new ConflictHttpException('Esse arquivo já foi carregado.');
        }

        $storedName = $file->store('uploads', 'local');

        $upload = new FileUpload([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'hash' => $hash,
            'status' => 'pending',
            'reference_date' => $this->extractDateFromFilename($file->getClientOriginalName()),
        ]);

        $this->fileUploadRepository->save($upload);

        ProcessInstrumentFileJob::dispatch($upload);

        return $upload;
    }

    private function extractDateFromFilename(string $filename): ?string
    {
        preg_match('/(\d{8})/', $filename, $matches);

        return isset($matches[1])
            ? Carbon::createFromFormat('Ymd', $matches[1])->toDateString()
            : null;
    }
}
