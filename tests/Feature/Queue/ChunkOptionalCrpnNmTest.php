<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadChunkJob;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class ChunkOptionalCrpnNmTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_chunk_processes_rows_even_when_crpn_nm_is_empty(): void
    {
        $upload = Upload::query()->create([
            'filename' => 'chunk-empty-crpn.csv',
            'path' => 'uploads/chunk-empty-crpn.csv',
            'mime_type' => 'text/csv',
            'size' => 1,
            'file_md5' => md5('chunk-empty-crpn.csv'),
            'status' => Upload::STATUS_PROCESSING,
            'rows_total' => 1,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadChunkJob(
            uploadId: $upload->id,
            rows: [$this->validRowWithoutCrpnNm()],
            chunkIndex: 0,
            requestId: 'req-empty-crpn-123',
        );

        $job->handle(app(UploadRepository::class));

        $this->assertDatabaseHas('market_data', [
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'AAPLI590',
            'mkt_nm' => 'EQUITY-DERIVATE',
            'scty_ctgy_nm' => 'OPTION ON EQUITIES',
            'isin' => 'BRAAPL9I0010',
            'crpn_nm' => '',
        ]);

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'processed_rows' => 1,
            'failed_rows' => 0,
        ]);
    }

    /**
     * @return array<int, mixed>
     */
    private function validRowWithoutCrpnNm(): array
    {
        return [
            '2026-03-23',
            'AAPLI590',
            'AAPL34',
            'AAPL',
            'EQUITY CALL',
            'EQUITY-DERIVATE',
            'OPTION ON EQUITIES',
            '2024-09-20',
            null,
            '2024-06-28',
            '2024-09-20',
            null,
            null,
            null,
            null,
            'BRAAPL9I0010',
            'OCASPS',
            null,
            null,
            'Call',
            null,
            null,
            '10',
            'BRL',
            'FINANCIAL',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            '58,95',
            'AMER',
            null,
            'true',
            null,
            '151',
            '1',
            '1',
            'SEM CORRECAO',
            'true',
            'false',
            null,
            '',
        ];
    }
}
