<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Request;


/**
 * Class UploadFileHistorySelectCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class UploadFileHistorySelectCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
       

        $original_name = Request::input('original_name');

        if (isset($original_name) && !empty($original_name)) {
            $model = $model->where('original_name', $original_name);            
        }

        $date = Request::input('date');

        if (isset($date) && !empty($date)) {
            $model = $model->whereDate('created_at', $date);            
        }

        return $model;
    }
}
