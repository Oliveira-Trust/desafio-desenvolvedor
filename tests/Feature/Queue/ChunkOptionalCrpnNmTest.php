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

    public function test_chunk_processes_rows_even_when_scty_ctgy_nm_and_isin_are_empty(): void
    {
        $upload = Upload::query()->create([
            'filename' => 'chunk-empty-optional-fields.csv',
            'path' => 'uploads/chunk-empty-optional-fields.csv',
            'mime_type' => 'text/csv',
            'size' => 2,
            'file_md5' => md5('chunk-empty-optional-fields.csv'),
            'status' => Upload::STATUS_PROCESSING,
            'rows_total' => 2,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadChunkJob(
            uploadId: $upload->id,
            rows: [
                $this->validRowWithoutSctyCtgyNmAndCrpnNm(),
                $this->validRowWithoutIsinAndCrpnNm(),
            ],
            chunkIndex: 1,
            requestId: 'req-empty-optional-fields-123',
        );

        $job->handle(app(UploadRepository::class));

        $this->assertDatabaseHas('market_data', [
            'upload_id' => $upload->id,
            'tckr_symb' => 'AFSF25',
            'mkt_nm' => 'FUTURE',
            'scty_ctgy_nm' => '',
            'isin' => 'BRBMEFAFS206',
            'crpn_nm' => '',
        ]);

        $this->assertDatabaseHas('market_data', [
            'upload_id' => $upload->id,
            'tckr_symb' => 'CRTE3T',
            'mkt_nm' => 'EQUITY-DERIVATE',
            'scty_ctgy_nm' => 'COMMON EQUITIES FORWARD',
            'isin' => '',
            'crpn_nm' => '',
        ]);

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'processed_rows' => 2,
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

    /**
     * @return array<int, mixed>
     */
    private function validRowWithoutSctyCtgyNmAndCrpnNm(): array
    {
        return [
            '2026-03-23',
            'AFSF25',
            'AFS',
            'Rande da Africa do Sul por Dolar dos Estados Unidos da America',
            'FINANCIAL',
            'FUTURE',
            '',
            '2025-01-02',
            'F25',
            '2024-07-31',
            '2024-12-30',
            null,
            null,
            null,
            null,
            'BRBMEFAFS206',
            'FFCCSX',
            null,
            null,
            '10',
            '1000',
            '1',
            'ZAR',
            'Financial',
            '90',
            '88',
            '132',
            null,
            null,
            '200000217406',
            'RTRZARD1',
            '10009865',
            'ZAR-PF',
            null,
            null,
            null,
            'Price',
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
            '',
        ];
    }

    /**
     * @return array<int, mixed>
     */
    private function validRowWithoutIsinAndCrpnNm(): array
    {
        return [
            '2026-03-23',
            'CRTE3T',
            'CRTE',
            'CRTE',
            'EQUITY FORWARD',
            'EQUITY-DERIVATE',
            'COMMON EQUITIES FORWARD',
            null,
            null,
            '2005-06-07',
            '9999-12-31',
            null,
            null,
            null,
            null,
            '',
            'EMXXXR',
            null,
            null,
            null,
            null,
            '1',
            'BRL',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            '193',
            '1',
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
            null,
            null,
            null,
            null,
            null,
            '',
        ];
    }
}
