<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUploadChunkJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    public function __construct(
        public readonly int $uploadId,
        public readonly array $rows,
        public readonly int $chunkIndex,
    ) {
        $this->onQueue('ingestion');
    }

    public function handle(): void
    {
        // A tarefa 2 termina no recebimento assíncrono do chunk.
        // O processamento linha a linha entra na tarefa 3.
    }
}
