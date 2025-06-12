<?php

namespace Application\Files\UseCases;

use Infrastructure\Laravel\Database\Repositories\MongoDBConsolidatedFileRepository;
use Presentation\Api\V1\Resources\Files\SearchFileResource;
use Shared\Enums\HttpStatus;
use Shared\Exceptions\HttpException;
use Shared\Interfaces\UseCase;

final class SearchFileUseCase implements UseCase {
    public function __construct(private MongoDBConsolidatedFileRepository $repository)
    {
    }

    public function execute($data)
    {
        $existsData = $this->repository->searchData($data->filename, $data->s);
        if (!$existsData) {
            throw new HttpException('Register not found', HttpStatus::NotFound);
        }

        return new SearchFileResource($existsData);
    }
}
