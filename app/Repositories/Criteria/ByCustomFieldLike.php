<?php


namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByCustomFieldLike
 * @package App\Repositories\Criteria
 */
class ByCustomFieldLike extends AbstractCriteria
{
    /**
     * @var null
     */
    private $fields;
    /**
     * @var null
     */
    private $value;

    /**
     * ByCustomFieldLike constructor.
     * @param null $field
     * @param null $value
     */
    public function __construct($fields = [], $value = null)
    {
        $this->fields = $fields;
        $this->value = $value;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $this->repository->model();

        $handlerFields = implode(" ,'@', ", $this->fields);

        $query = $model->whereRaw(
            "concat($handlerFields) like ?",
            ["%" . strtolower($this->value) . "%"]
        );

        return $query;
    }
}
