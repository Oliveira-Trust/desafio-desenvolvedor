<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class ProfilesBySearchCriteria
 * @package App\Repositories\Criteria
 */
class ProfilesByCPFCNPJCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $documentNumber;

    /**
     * ProfilesBySearchCriteria constructor.
     * @param $documentNumber
     */
    public function __construct($documentNumber)
    {
        $this->documentNumber = $documentNumber;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        // require a previous join query on user_profiles
        $query = $model->join('v_document_shared_via_profile', function ($join) {
            $join->on('v_document_shared_via_profile.profile_id', '=', 'profiles.id');
        })->whereIn('v_document_shared_via_profile.document_id', function ($query) {
            $query
                ->select('document_id')
                ->from('document_fields')
                ->whereIn('document_field_type_id', [
                    config('document.fields.numero_cpf'),
                    config('document.fields.numero_cnpj'),
                ])
                ->where('value', '=', $this->documentNumber);
        })->groupBy('profiles.id');

        return $query;
    }
}
