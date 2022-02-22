<?php

namespace App\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\RepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractBaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel($this->model);
    }

    public function setModel(string $modelClass) : void
    {
        $this->model = app($modelClass);
    }

    public function getModel(): Model
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        throw new Exception('Model not instanceof of Illuminate\Database\Eloquent\Model');
    }

    public function create(array $data) : Model
    {
        return $this->getModel()->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        return $this->getModel()->update($data);
    }

    public function updateOrCreate($searchData, $updateData) : Model
    {
        return $this->getModel()->updateOrCreate($searchData, $updateData);
    }

    public function deleteByIds(array $ids) : bool
    {
        return $this->getModel()->whereIn('id', $ids)->delete();
    }

    public function forceDeleteByIds(array $ids) : bool
    {
        return $this->getModel()->whereIn('id', $ids)->forceDelete();
    }

    public function find(int $id) : ?Model
    {
        return $this->getModel()->find($id);
    }

    public function findBy(array $data) : Builder
    {
        return $this->getModel()->where($data);
    }

    public function findByWithRelations(array $data, array $relations) : Builder
    {
        return $this->getModel()->with($relations)->where($data);
    }

    public function findCollectionByWithRelations(array $data, array $relations) : Collection
    {
        return $this->findByWithRelations($data, $relations)->get();
    }

    public function findCollectionBy(array $data) : Collection
    {
        return $this->findBy($data)->get();
    }

    public function findOneByWithRelations(array $data, array $relations) : ?Model
    {
        return $this->findByWithRelations($data, $relations)->first();
    }

    public function findOneBy(array $data) : ?Model
    {
        return $this->findBy($data)->first();
    }

    public function findByIds(array $ids) : Collection
    {
        return $this->getModel()::whereIn('id', $ids)->get();
    }

    public function createByArray(array $itens) : bool
    {
        $createdAt = Carbon::now();
        return $this->getModel()::insert(array_reduce($itens, function ($result, $item) use ($createdAt) {
            $item['created_at'] = $createdAt;
            $item['updated_at'] = $createdAt;
            $result[] = $item;
            return $result;
        }));
    }

    public function findCollectionByOrder(array $data, array $fieldsOrder) : Collection
    {
        $build = $this->findBy($data);
        foreach ($fieldsOrder as $field => $order) {
            $build->orderBy($field, $order);
        }
        return $build->get();
    }

    public function getAll(
        array $columns = ['*'],
        string $orderBy = 'default',
        string $orderByDirection = 'asc'
    ) : Collection {
        $orderBy = $orderBy === 'default' ? $this->getModel()->getKeyName() : $orderBy;
        return $this->getModel()->orderBy($orderBy, $orderByDirection)->get($columns);
    }

    public function setCancellationCondition(&$query, string $column)
    {
        return $query->where(function ($queryCanceledAt) use ($column) {
            return $queryCanceledAt->whereNull("{$column}")
                ->orWhereDate("{$column}", '>=', Carbon::now());
        });
    }
}
