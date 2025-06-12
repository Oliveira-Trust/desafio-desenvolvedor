<?php

namespace Application\Files\UseCases;

use Infrastructure\Laravel\Database\Repositories\MongoDBConsolidatedFileRepository;
use Presentation\Api\V1\Resources\Files\GetFileHistoryResource;
use Shared\Interfaces\UseCase;

final class GetHistoryUseCase implements UseCase {
    public function __construct(
        private MongoDBConsolidatedFileRepository $repository,
    )
    {}

    public function execute($data)
    {
        $files = $this->repository->getHistory($data->filename, $data->date);
        return GetFileHistoryResource::collection($files);
    }
}
