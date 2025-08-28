<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ImportDataFileSearchCriteria.
 *
 * @package namespace App\Criteria;
 */
class ImportDataFileSearchCriteria implements CriteriaInterface
{
    public function __construct(private $request)
    {
    }
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
        $model = $model->select('*');

        $tckrSymb = $this->request->get('TckrSymb');
        if(isset($tckrSymb) && !empty($tckrSymb)){
            $model = $model->where('TckrSymb', $tckrSymb);
        }

        $rptDt = $this->request->get('RptDt');
        if(isset($rptDt) && !empty($rptDt)){
            $model = $model->where('TckrSymb', $rptDt);
        }
        
        return $model;
    }
}
