<?php

namespace App\Abstracts;

use App\Interfaces\RepositoryInterface;
use App\Interfaces\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractBaseService implements ServiceInterface
{
    protected $repository;
    protected $payload;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function decodeId(string $id) : int
    {
        return  $this->repository->getModel()->decodeField($id);
    }

    public function encodeId(string $id) : string
    {
        return  $this->repository->getModel()->encodeField($id);
    }

    public function create(array $data) : Model
    {
        return $this->repository->create($data);
    }

    public function update(Model $modelObject, array $data) : bool
    {
        return $modelObject->fill($data)->update();
    }

    public function updateOrCreate(array $searchData, array $updateData) : Model
    {
        return $this->repository->updateOrCreate($searchData, $updateData);
    }

    public function delete(int $id) : bool
    {
        return $this->repository->getModel()->destroy($id);
    }

    public function forceDelete(Model $model) : bool
    {
        return $model->forceDelete();
    }

    public function forceDeletePreservingMedia(Model $model) : bool
    {
        return $model->preservingMedia()->forceDelete();
    }

    public function deleteByIds(array $ids) : bool
    {
        return $this->repository->deleteByIds($ids);
    }

    public function forceDeleteByIds(array $ids) : bool
    {
        return $this->repository->forceDeleteByIds($ids);
    }

    public function find(int $id) : ?Model
    {
        return $this->repository->find($id);
    }

    public function findOneBy(array $data) : ?Model
    {
        return $this->repository->findOneBy($data);
    }

    public function findByIds(array $ids) : Collection
    {
        return $this->repository->findByIds($ids);
    }

    public function findOrCreate(array $findFields, array $data) : Model
    {
        return ($this->findOneBy($findFields)) ?: $this->create($data);
    }

    public function extractDecodesIds(array $data) : array
    {
        return array_map(function ($item) use ($data) {
             return $this->decodeId($item['id']);
        }, $data);
    }

    public function findCollectionByOrder(array $data, array $fieldsOrder) : Collection
    {
        return $this->repository->findCollectionByOrder($data, $fieldsOrder);
    }

    public function createByArray(array $listModel) : bool
    {
        return $this->repository->createByArray($listModel);
    }

    public function getAll(
        $columns = ['*'],
        string $orderBy = 'default',
        string $orderByDirection = 'asc'
    ) : Collection {
        return $this->repository->getAll($columns, $orderBy, $orderByDirection);
    }

    public function setPayloadError($body, string $statusCode): void
    {
        $this->setPayload(['errors' => $body], $statusCode);
    }

    public function setPayload($body, string $statusCode): void
    {
        $this->payload = ['body' => $body, 'statusCode' => $statusCode];
    }

    public function getPayload(): object
    {
        return (object)$this->payload;
    }

    public function hasErrorPayload(): bool
    {
        return !empty($this->payload['body']['errors']);
    }
}
