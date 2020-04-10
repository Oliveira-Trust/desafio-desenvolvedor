<?php

namespace App\Repositories;

abstract class AbstractRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
    * Find with condition
    */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $model = $this->model;
        
        /**
        * Find by criteria
        */
        if (count($criteria) == 1) {
            $cKey = array_keys($criteria)[0];
            $cValue = $criteria[$cKey];
            // check whether model table has the query column
            if(\Schema::hasColumn($model->getTable(), $cKey)) {
                $model = $model->where($cKey, 'like', "%$cValue%");
            }

        } elseif (count($criteria) > 1) {
            foreach ($criteria as $cKey => $cValue) {
                if(\Schema::hasColumn($model->getTable(), $cKey)) {
                    $model = $model->where($cKey, 'like', "%$cValue%");
                }
            }
        }
        
        /**
        * Order by
        */
        if ($orderBy && count($orderBy) == 1) {
            $oKey = array_keys($orderBy)[0];
            $oValue = $orderBy[$oKey];
            if(\Schema::hasColumn($model->getTable(), $oKey)) {
                $model = $model->orderBy($oKey, $oValue);
            }

        } elseif ($orderBy && count($orderBy > 1)) {
            foreach ($orderBy as $oKey => $oValue) {
                if(\Schema::hasColumn($model->getTable(), $oKey)) {
                    $model = $model->orderBy($oKey, $oValue);
                }
            }
        }

        if ($limit) {
            $model = $model->take((int)$limit);
        }

        if ($offset) {
            $model = $model->skip((int)$offset);
        }

        return $model->get();
    }

    public function paginate($pages)
    {
        return $this->model->paginate($pages);
    }
}