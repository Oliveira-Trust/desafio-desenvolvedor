<?php

namespace App\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModel\ConditionsTrait;
use App\Traits\EloquentModel\FactoryModelTrait;
use Illuminate\Container\Container as Application;

abstract class BaseRepository
{

    use ConditionsTrait,
        FactoryModelTrait;

    /**
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct()
    {
        $this->initModel();
        $this->boot();
    }

    abstract public function model();
    public function boot()
    {

    }
    public function orderBy(string $field, string $order = 'asc')
    {
        $this->model = $this->model->orderBy($field, $order);
        return $this;
    }

    public function whereIn(string $field, array $values)
    {
        $this->model = $this->model->whereIn($field, $values);
        return $this;
    }

    public function whereNotIn(string $field, array $values)
    {
        $this->model = $this->model->whereNotIn($field, $values);
        return $this;
    }

    public function whereHas(string $field, $function)
    {
        $this->model = $this->model->whereHas($field, $function);
        return $this;
    }

    public function withTrashed()
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }
    /**
     *
     * @param array $where
     * @return type
     */
    public function where(array $where)
    {
        $this->applyConditions($where);
        return $this;
    }

    /**
     *
     * @param array $where
     * @return type
     */
    public function whereNull(string $field)
    {

        $this->model = $this->model->whereNull($field);
        return $this;
    }

    /**
     *
     * @param array $where
     * @return type
     */
    public function with(array $relations)
    {

	    $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     *
     * @param array $where
     * @return type
     */
    public function has(string $field)
    {

        $this->model = $this->model->has($field);
        return $this;
    }
    /**
     *
     * @param array $where
     * @return type
     */
    public function groupBy(string $field)
    {

        $this->model = $this->model->groupBy($field);
        return $this;
    }

    /**
     *
     * @param array $where
     * @return type
     */
    public function whereNotNull(string $field)
    {

        $this->model = $this->model->whereNotNull($field);
        return $this;
    }

    public function all()
    {
        $result = $this->model->all();
        $this->initModel();
        return $result;
    }

    public function findById($id)
    {
        $result = $this->model->find($id);
        $this->initModel();
        return $result;
    }

    public function find($id, array $columns = ['*'])
    {
        $result = $this->model->find($id, $columns);
        $this->initModel();
        return $result;
    }

    public function findWith(string $id, array $relations)
    {

        $result = $this->model->with($relations)->find($id);
        $this->initModel();
        return $result;
    }

    public function findWhereIn(string $field, array $values)
    {
        $result = $this->model->whereIn($field, $values)->get() ?? collect([]);
        $this->initModel();
        return $result;
    }

    public function findWhereNotIn(string $field, array $values)
    {
        $result = $this->model->whereNotIn($field, $values)->get() ?? collect([]);
        $this->initModel();
        return $result;
    }
    public function whereBetween(string $field, array $values)
    {
        $result = $this->model->whereBetween($field, $values);
        return $result;
    }
    public function findWhere(array $conditions)
    {
        $result = $this->model->where($conditions)->get() ?? collect([]);
        $this->initModel();
        return $result;
    }

    public function get()
    {
        $result = $this->model->get();
        $this->initModel();
        return $result;
    }

    public function first()
    {

        $result = $this->model->first();
        $this->initModel();
        return $result;
    }

    public function toSql()
    {
        return $this->model->toSql();
    }
    public function paginate(int $totalPerPage)
    {
        $result = $this->model->paginate($totalPerPage);
        $this->initModel();
        return $result;
    }

    /**
     * Retorna uma instêncaia vazia do model
     * @return \App\Abstracts\getModel
     */
    public function getModel()
    {
        $this->initModel();
        return $this->model;
    }

    public function create($data)
    {
        $model = $this->model->create($data);
        $this->initModel();
        return $model;
    }

    public function firstOrCreate($data)
    {
        $result = $this->model->firstOrCreate($data);
        $this->initModel();
        return $result;
    }

    public function updateOrCreate($data)
    {
        $result = $this->model->updateOrCreate($data);
        $this->initModel();
        return $result;
    }

    public function save()
    {
        $result = $this->model->save();
        $this->initModel();
        return $result;
    }

    public function update(string $id, array $data)
    {
        $this->model->where(['id' => $id])->update($data);
        $this->initModel();
        return $this;
    }

    public function delete(string $id)
    {
        $this->model = $this->model->find($id);
        $del = $this->model ? $this->model->delete() : 0;
        $this->initModel();
        return $del;
    }

}
