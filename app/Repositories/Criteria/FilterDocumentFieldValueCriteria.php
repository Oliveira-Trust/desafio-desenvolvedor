<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class FilterDocumentFieldValueCriteria
 * @package App\Repositories\Criteria
 */
class FilterDocumentFieldValueCriteria extends AbstractCriteria
{
    protected $type;
    protected $value;

    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function applyToQuery($model)
    {
        switch ($this->type) {
        case 'model':
            return $this->filterByModelValue($model);

        case 'text':
            return $this->filterByTextValue($model);

        case 'string':
            return $this->filterByStringValue($model);
        }

        return $model;
    }

    protected function filterByStringValue($model)
    {
        $morphTypes = [
            \App\Models\StringValue::class
        ];

        return $model->whereHasMorph('value', $morphTypes, function ($query) {
            if (is_array($this->value)) {
                return $query->whereIn('data', $this->value);
            }

            return $query->where('data', $this->value);
        });
    }

    protected function filterByTextValue($model)
    {
        $morphTypes = [
            \App\Models\TextValue::class
        ];

        return $model->whereHasMorph('value', $morphTypes, function ($query) {
            if (is_array($this->value)) {
                return $query->whereIn('checksum', $this->value);
            }

            return $query->where('checksum', $this->value);
        });
    }

    protected function filterByModelValue($model)
    {
        $morphTypes = [
            \App\Models\ModelValue::class
        ];

        return $model->whereHasMorph('value', $morphTypes, function ($query) {
            if (empty($this->value['model_id']) || empty($this->value['model_type'])) {
                return;
            }

            $query->where('model_id', $this->value['model_id'])
                ->where('model_type', $this->value['model_type']);
        });
    }
}
