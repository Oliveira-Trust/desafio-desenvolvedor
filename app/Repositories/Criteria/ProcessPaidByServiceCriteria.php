<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class ActByStampAvailableCriteria
 * @package App\Repositories\Criteria
 */
class ProcessPaidByServiceCriteria extends AbstractCriteria
{
    /**
     * @var bool
     */
    private $paid;

    public function __construct($paid = true)
    {
        $this->paid = $paid;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if ($this->paid) {
            $operator = '<=';
        } else {
            $operator = '>';
        }
        return $model->whereRaw("(SELECT (COUNT(processes.id) - 1) AS total FROM processes WHERE processes.protocol_id = protocols.id) $operator (SELECT COUNT(payment_processes.id) AS total FROM processes INNER JOIN payment_processes ON processes.id = payment_processes.process_id WHERE processes.protocol_id = protocols.id)");
    }
}
