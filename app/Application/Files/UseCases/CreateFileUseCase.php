<?php

namespace Application\Files\UseCases;

use Application\Files\Services\ConsolidatedFileService;
use Domain\Files\Entities\ConsolidatedFile;
use Domain\Files\Enums\ConsolidatedFileStatus;
use Domain\Files\Exceptions\FileAlreadyExistsException;
use Infrastructure\Laravel\Database\Repositories\MongoDBConsolidatedFileRepository;
use Presentation\Api\V1\Resources\Files\CreateFileResource;
use Shared\Interfaces\UseCase;

final class CreateFileUseCase implements UseCase {
    public function __construct(
        private ConsolidatedFileService $service,
        private MongoDBConsolidatedFileRepository $repository,
    )
    {}

    public function execute($data) {
        $filename = $data->file->getClientOriginalName();
        $path = $this->service->resolvePath($filename);

        if ($this->service->exists($filename)) {
            throw new FileAlreadyExistsException($filename);
        }

        $path = $this->service->store($filename, $data->file);

        $consolidatedFile = ConsolidatedFile::create(
            $filename,
            $path,
            ConsolidatedFileStatus::PROCESSING,
        );

        $this->service->sendToQueue($filename);

        return new CreateFileResource($consolidatedFile);
    }
}
