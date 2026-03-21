<?php

namespace App\Jobs;

use App\Domains\Upload\Application\Ports\UploadRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Reader\Common\Creator\ReaderFactory;

class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly int $uploadId,
    ) {}

    public function handle(UploadRepository $uploads): void
    {
        $upload = $uploads->findById($this->uploadId);

        if ($upload === null) {
            return;
        }

        $uploads->markAsProcessing($this->uploadId);

        $disk = Storage::disk('local');

        if (! $disk->exists($upload->path)) {
            throw new \RuntimeException('Arquivo do upload nao encontrado.');
        }

        $absolutePath = $disk->path($upload->path);
        $reader = ReaderFactory::createFromFile($absolutePath);

        try {
            $reader->open($absolutePath);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();

                    // Aqui, por enquanto, voce pode:
                    // 1. contar linhas
                    // 2. montar chunks
                    // 3. depois despachar ProcessUploadChunkJob
                }
            }
        } finally {
            $reader->close();
        }
    }
}
