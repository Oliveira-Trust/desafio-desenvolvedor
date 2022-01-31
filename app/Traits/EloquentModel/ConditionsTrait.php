<?php

namespace App\Traits\EloquentModel;

trait ConditionsTrait
{

        /**
         * Applies the given where conditions to the model.
         *
         * @param array $where
         * @return void
         */
        protected function applyConditions(array $where)
        {

                foreach ($where as $field => $value)
                {
                        if (!is_array($value))
                        {
                                if (count($where) === 3)
                                {
                                        list($fieldName, $condition, $val) = $where;
                                        $this->model = $this->model->where($fieldName, $condition, $val);
                                } else if (count($where) === 2)
                                {
                                        list($fieldName, $val) = $where;
                                        $this->model = $this->model->where($fieldName, '=', $val);
                                }
                                break;
                        } else
                        {
                                if (count($value) === 3)
                                {
                                        list($fieldName, $condition, $val) = $value;
                                        $this->model = $this->model->where($fieldName, $condition, $val);
                                } else if (count($value) === 2)
                                {
                                        list($fieldName, $val) = $value;
                                        $this->model = $this->model->where($fieldName, '=',$val);
                                }
                        }
                }
                return $this->model;
        }

}
