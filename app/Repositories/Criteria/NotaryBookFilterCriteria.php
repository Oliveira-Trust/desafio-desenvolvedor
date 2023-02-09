<?php


namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByCustomFieldLike
 * @package App\Repositories\Criteria
 */
class NotaryBookFilterCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $notaryBookType;
    /**
     * @var null
     */
    private $value;

    /**
     * ByCustomFieldLike constructor.
     * @param $notaryBookType
     * @param $value
     */
    public function __construct($notaryBookType, $value)
    {
        $this->notaryBookType = $notaryBookType;
        $this->value = preg_replace('/\s+/', '%', $value);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $m = $this->repository->model();
        $table = with(new $m)->getTable();

        $model->join('notary_book_raw_drafts', function ($join) USE ($table) {
            $join->on('notary_book_raw_drafts.notary_book_id', '=', "${table}.id")
                ->where('notary_book_raw_drafts.notary_book_type', '=', $this->notaryBookType);
        })->where(function ($query) use ($table) {
            $query->where("${table}.property_registry_number", $this->value)
                ->orWhere("notary_book_raw_drafts.content", 'LIKE', '%' . $this->value . '%');
        });

        return $model;
    }
}
