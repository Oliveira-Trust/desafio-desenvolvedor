<?php

namespace App\Jobs;

use App\Domains\MarketData\Application\DTOs\MarketDataDTO;
use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Jobs\Concerns\DetectsTransientFailures;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessUploadChunkJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Batchable;
    use Queueable;
    use SerializesModels;
    use DetectsTransientFailures;

    private const COLUMN_RPT_DT = 0;
    private const COLUMN_TCKR_SYMB = 1;
    private const COLUMN_MKT_NM = 5;
    private const COLUMN_SCTY_CTGY_NM = 6;
    private const COLUMN_ISIN = 15;
    private const COLUMN_CRPN_NM = 47;

    public int $tries;
    public int $timeout;

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    public function __construct(
        public readonly int $uploadId,
        public readonly array $rows,
        public readonly int $chunkIndex,
        public readonly ?string $requestId = null,
    ) {
        $this->tries = (int) config('ingestion.jobs.chunk.tries', 3);
        $this->timeout = (int) config('ingestion.jobs.chunk.timeout', 300);
        $this->onQueue('ingestion');
    }

    public function handle(UploadRepository $uploads): void
    {
        $startedAt = microtime(true);

        $this->logInfo('ingestion.upload_chunk.started', 'processing', $startedAt);

        try {
            $now = now();
            $inserts = [];
            $processedRows = 0;
            $failedRows = 0;

            foreach ($this->rows as $row) {
                if ($this->shouldSkipRow($row)) {
                    continue;
                }

                $dto = $this->mapRowToDto($row);

                if ($dto === null) {
                    $failedRows++;
                    continue;
                }

                $inserts[] = [
                    'upload_id' => $dto->uploadId,
                    'rpt_dt' => $dto->rptDt,
                    'tckr_symb' => $dto->tckrSymb,
                    'mkt_nm' => $dto->mktNm,
                    'scty_ctgy_nm' => $dto->sctyCtgyNm,
                    'isin' => $dto->isin,
                    'crpn_nm' => $dto->crpnNm,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $processedRows++;
            }

            if ($inserts !== []) {
                MarketData::query()->insert($inserts);
            }

            if ($processedRows === 0 && $failedRows === 0) {
                $this->logInfo('ingestion.upload_chunk.skipped', 'completed', $startedAt, [
                    'processed_rows' => 0,
                    'failed_rows' => 0,
                ]);

                return;
            }

            $uploads->incrementProgress($this->uploadId, $processedRows, $failedRows);

            $this->logInfo('ingestion.upload_chunk.completed', 'completed', $startedAt, [
                'processed_rows' => $processedRows,
                'failed_rows' => $failedRows,
            ]);
        } catch (Throwable $exception) {
            if ($this->shouldRetryAfterFailure($exception)) {
                $this->logWarning('ingestion.upload_chunk.retrying', 'retrying', $startedAt, $exception, [
                    'retryable' => true,
                ]);

                throw $exception;
            }

            $this->logError('ingestion.upload_chunk.failed', 'failed', $startedAt, $exception, [
                'retryable' => false,
            ]);

            $this->fail($exception);
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('ingestion.upload_chunk.failed.final', $this->buildLogContext([
            'status' => 'failed',
            'duration_ms' => 0,
            'exception_class' => $exception ? $exception::class : null,
            'error_message' => $exception?->getMessage(),
        ]));

        app(UploadRepository::class)->incrementProgress(
            $this->uploadId,
            0,
            $this->countDataRows($this->rows)
        );
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function mapRowToDto(array $row): ?MarketDataDTO
    {
        $rptDt = $this->normalizeDate($row[self::COLUMN_RPT_DT] ?? null);
        $tckrSymb = $this->normalizeString($row[self::COLUMN_TCKR_SYMB] ?? null);
        $mktNm = $this->normalizeString($row[self::COLUMN_MKT_NM] ?? null);
        $sctyCtgyNm = $this->normalizeString($row[self::COLUMN_SCTY_CTGY_NM] ?? null);
        $isin = $this->normalizeString($row[self::COLUMN_ISIN] ?? null);
        $crpnNm = $this->normalizeString($row[self::COLUMN_CRPN_NM] ?? null);

        if ($rptDt === null || $tckrSymb === null || $mktNm === null || $sctyCtgyNm === null || $isin === null || $crpnNm === null) {
            return null;
        }

        return new MarketDataDTO(
            uploadId: $this->uploadId,
            rptDt: $rptDt,
            tckrSymb: $tckrSymb,
            mktNm: $mktNm,
            sctyCtgyNm: $sctyCtgyNm,
            isin: $isin,
            crpnNm: $crpnNm,
        );
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function shouldSkipRow(array $row): bool
    {
        $firstColumn = $this->normalizeString($row[0] ?? null);

        if ($firstColumn === null) {
            return true;
        }

        if ($firstColumn === 'RptDt') {
            return true;
        }

        return str_starts_with($firstColumn, 'Status do Arquivo:');
    }

    private function normalizeString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim((string) $value);

        return $normalized === '' ? null : $normalized;
    }

    private function normalizeDate(mixed $value): ?string
    {
        $normalized = $this->normalizeString($value);

        if ($normalized === null) {
            return null;
        }

        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $normalized);

        if ($date === false || $date->format('Y-m-d') !== $normalized) {
            return null;
        }

        return $normalized;
    }

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    private function countDataRows(array $rows): int
    {
        $count = 0;

        foreach ($rows as $row) {
            if (! $this->shouldSkipRow($row)) {
                $count++;
            }
        }

        return $count;
    }

    public function backoff(): array
    {
        return config('ingestion.jobs.chunk.backoff', [5, 15, 30, 60]);
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function buildLogContext(array $context = []): array
    {
        return array_merge([
            'request_id' => $this->requestId,
            'upload_id' => $this->uploadId,
            'chunk' => $this->chunkIndex,
            'attempt' => $this->attempts(),
        ], $context);
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logInfo(string $message, string $status, float $startedAt, array $context = []): void
    {
        Log::info($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
        ])));
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logWarning(string $message, string $status, float $startedAt, Throwable $exception, array $context = []): void
    {
        Log::warning($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
            'exception_class' => $exception::class,
            'error_message' => $exception->getMessage(),
        ])));
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logError(string $message, string $status, float $startedAt, Throwable $exception, array $context = []): void
    {
        Log::error($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
            'exception_class' => $exception::class,
            'error_message' => $exception->getMessage(),
        ])));
    }

    private function durationMs(float $startedAt): int
    {
        return (int) ((microtime(true) - $startedAt) * 1000);
    }
}
