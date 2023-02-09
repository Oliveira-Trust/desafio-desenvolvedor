<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionByAccountCriteria
 * @package App\Repositories\Criteria
 */
class TransactionByAccountCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $id;

    /**
     * GroupByCriteria constructor.
     * @param Model $account
     */
    public function __construct(Model $account)
    {
        $this->type = get_class($account);
        $this->id = $account->id;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->where(function ($query) {
            $query->where([
                ['to_id', '=', $this->id],
                ['to_type', '=', $this->type],
            ])
                ->orWhere([
                    ['from_id', '=', $this->id],
                    ['from_type', '=', $this->type],
                ]);
        });

        return $query;
    }
}
