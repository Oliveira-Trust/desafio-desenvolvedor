<?php

namespace Tests\Unit\Upload;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Application\Ports\UploadStorage;
use App\Domains\Upload\Application\Services\UploadService;
use App\Domains\Upload\Domain\Entities\Upload;
use App\Domains\Upload\Exceptions\DuplicateUploadException;
use App\Jobs\ProcessUploadJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class UploadServiceTest extends TestCase
{
    public function test_upload_list_delegates_pagination_to_repository(): void
    {
        $repository = Mockery::mock(UploadRepository::class);
        $storage = Mockery::mock(UploadStorage::class);
        $paginator = new LengthAwarePaginator([], 0, 10, 1);

        $repository
            ->shouldReceive('paginate')
            ->once()
            ->with(10, 'market', '2026-03-23')
            ->andReturn($paginator);

        $service = new UploadService($repository, $storage);

        $result = $service->uploadList(10, 'market', '2026-03-23');

        $this->assertSame($paginator, $result);
    }

    public function test_upload_file_stores_the_upload_and_dispatches_processing_job(): void
    {
        Queue::fake();

        $file = UploadedFile::fake()->create('market-data.csv', 10, 'text/csv');
        $fileMd5 = md5_file($file->getRealPath());

        $repository = Mockery::mock(UploadRepository::class);
        $storage = Mockery::mock(UploadStorage::class);

        $repository
            ->shouldReceive('existsByFileMd5')
            ->once()
            ->with($fileMd5)
            ->andReturn(false);

        $storage
            ->shouldReceive('store')
            ->once()
            ->with($file, 'uploads')
            ->andReturn('uploads/stored-market-data.csv');

        $repository
            ->shouldReceive('create')
            ->once()
            ->withArgs(function (Upload $upload) use ($file, $fileMd5): bool {
                return $upload->id === null
                    && $upload->filename === 'market-data.csv'
                    && $upload->path === 'uploads/stored-market-data.csv'
                    && $upload->mimeType === ($file->getMimeType() ?? 'application/octet-stream')
                    && $upload->size === ($file->getSize() ?? 0)
                    && $upload->fileMd5 === $fileMd5
                    && $upload->status === 'pending'
                    && $upload->rowsTotal === 0
                    && $upload->processedRows === 0
                    && $upload->failedRows === 0;
            })
            ->andReturn(new Upload(
                id: 123,
                filename: 'market-data.csv',
                path: 'uploads/stored-market-data.csv',
                mimeType: $file->getMimeType() ?? 'application/octet-stream',
                size: $file->getSize() ?? 0,
                fileMd5: $fileMd5,
                status: 'pending',
            ));

        $service = new UploadService($repository, $storage);

        $upload = $service->uploadFile($file, 'req-upload-service-123');

        $this->assertSame(123, $upload->id);
        $this->assertSame('pending', $upload->status);

        Queue::assertPushed(ProcessUploadJob::class, function (ProcessUploadJob $job): bool {
            return $job->uploadId === 123
                && $job->requestId === 'req-upload-service-123'
                && $job->queue === 'ingestion';
        });
    }

    public function test_upload_file_rejects_duplicate_files_before_storing_or_dispatching(): void
    {
        Queue::fake();

        $file = UploadedFile::fake()->create('duplicate.csv', 10, 'text/csv');
        $fileMd5 = md5_file($file->getRealPath());

        $repository = Mockery::mock(UploadRepository::class);
        $storage = Mockery::mock(UploadStorage::class);

        $repository
            ->shouldReceive('existsByFileMd5')
            ->once()
            ->with($fileMd5)
            ->andReturn(true);

        $storage->shouldNotReceive('store');
        $repository->shouldNotReceive('create');

        $service = new UploadService($repository, $storage);

        $this->expectException(DuplicateUploadException::class);

        try {
            $service->uploadFile($file, 'req-upload-duplicate-123');
        } finally {
            Queue::assertNothingPushed();
        }
    }
}
