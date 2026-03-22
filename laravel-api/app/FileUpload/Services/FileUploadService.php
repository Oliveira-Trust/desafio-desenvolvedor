<?php

declare(strict_types=1);

namespace App\FileUpload\Services;

use App\FileUpload\Http\Controllers\Resources\FileUploadResource;
use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Models\FileUpload;
use App\Instrument\Jobs\ProcessInstrumentFileJob;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class FileUploadService
{
    public function __construct(
        private readonly FileUploadRepositoryInterface $fileUploadRepository
    ) {}

    public function handle(UploadedFile $file): FileUploadResource
    {
        $hash = hash_file('sha256', $file->getRealPath());

        $existing = $this->fileUploadRepository->findByHash($hash);

        if ($existing) {
            if ($existing->status !== 'failed') {
                throw new ConflictHttpException('Esse arquivo já foi carregado.');
            }

            Storage::disk('local')->delete($existing->stored_name);
            $existing->instruments()->delete();
        }

        $storedName = $file->store('uploads', 'local');

        if ($existing) {
            $existing->update([
                'stored_name' => $storedName,
                'status' => 'pending',
                'total_rows' => 0,
                'error_message' => null,
                'reference_date' => $this->extractDateFromFilename($file->getClientOriginalName()),
            ]);

            $upload = $existing->fresh();
        } else {
            $upload = new FileUpload([
                'original_name' => $file->getClientOriginalName(),
                'stored_name' => $storedName,
                'hash' => $hash,
                'status' => 'pending',
                'reference_date' => $this->extractDateFromFilename($file->getClientOriginalName()),
            ]);

            $this->fileUploadRepository->save($upload);
        }

        ProcessInstrumentFileJob::dispatch($upload);

        Log::channel('upload_file')->info("Upload do arquivo {$file->getClientOriginalName()} realizado com sucesso!");

        return new FileUploadResource($upload);
    }

    private function extractDateFromFilename(string $filename): ?string
    {
        preg_match('/(\d{8})/', $filename, $matches);

        return isset($matches[1])
            ? Carbon::createFromFormat('Ymd', $matches[1])->toDateString()
            : null;
    }
}
