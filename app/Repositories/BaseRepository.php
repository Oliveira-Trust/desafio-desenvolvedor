<?php

namespace App\Repositories;

use App\Response\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IBaseRepository;

abstract class BaseRepository implements IBaseRepository
{
    protected $modelClass;

    /**
     * Return all entries
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return $this->modelClass::all();
    }

    /**
     * Get data by UUID
     *
     * @param string $uuid
     * @return Model
     */
    public function getById(string $uuid) : Model
    {
        return $this->modelClass::findByUuid($uuid);
    }

    /**
     * Create a new model instance
     *
     * @param  array  $data
     * @return JsonResponse
     */
    public function create(array $attr) : JsonResponse
    {
        $modelSave = $this->modelClass::create($attr);
        return JsonResponse::success(true, __("Message Success Insert"), $modelSave->toArray());
    }

    /**
     * Update a model instance
     *
     * @param  string  $uuid
     * @param  array  $data
     * @return JsonResponse
     */
    public function update(string $uuid, array $attr) : JsonResponse
    {
        $modelSave = $this->modelClass::where('uuid', $uuid)
            ->update($attr);

        return JsonResponse::success(true, __("Message Success Update"), $this->getById($uuid)->toArray());
    }

    /**
     * Delete a model instance
     *
     * @param  string  $uuid
     * @param  array  $data
     * @return JsonResponse
     */
    public function delete(string $uuid) : JsonResponse
    {
        $ModelDelete = $this->modelClass::where('uuid', $uuid)
            ->delete();

        return JsonResponse::success(true, __("Message Success Delete"));
    }

    /**
     * Get query builder of model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query() : Builder
    {
        return $this->modelClass::query();
    }
}