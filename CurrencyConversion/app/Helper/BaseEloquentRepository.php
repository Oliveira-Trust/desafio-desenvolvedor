<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait BaseEloquentRepository
{
    /**
     *
     *
     * @var ?integer
     */
    protected $id = null;

    /**
     * Entity
     *
     * @var \App\Model
     */
    protected $entity;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all results
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * Get the first result.
     *
     * @return void
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * Search for an item by ID
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id) : ?Model
    {
        if(!is_null($this->id)){
            $this->id = $id;
        }

        if($this->id != $id){
            $this->entity = $this->model->find($id);
        }

        return $this->entity;
    }

    /**
     * Search for an item by ID
     *
     * @param integer $id
     * @return void
     */
    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a item
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $this->entity = $this->model->create($data);
        return $this->entity;
    }

    /**
     * Update a item.
     *
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update (int $id, array $data)
    {
        if($this->id == $id){
            $this->entity->fill($data);
            $this->entity->save();
            return $this->entity;
        }else{
            $this->entity = $this->find($id);
            $this->entity->fill($data);
            $this->entity->save();
            return $this->entity;
        }

        return $this->find($id);
    }

    /**
     * Delete a item
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        if($this->id == $id AND !is_null($this->entity)){
            return $this->entity->delete($id);
        }

        $this->entity = $this->find($id);
        return  $this->entity->delete($id);
    }

    /**
     * It includes an array to compose the where in the model.
     *
     * @param array $data
     * @return Model|null
     */
    public function where(array $data)
    {
        return $this->model->where($data);
    }

    /**
     * Adds an item to where to search for a column and a range.
     *
     * @param string $column
     * @param array $data
     * @return Model|null
     */
    public function whereBetween(string $column, array $data)
    {
        return $this->model->whereBetween($column, $data);
    }

}
