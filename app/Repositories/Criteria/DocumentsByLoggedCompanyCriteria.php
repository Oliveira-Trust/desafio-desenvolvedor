<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class DocumentsByLoggedCompanyCriteria
 * @package App\Repositories\Criteria
 */
class DocumentsByLoggedCompanyCriteria extends AbstractCriteria
{
    private $companyId;
    /**
     * @var null
     */
    private $documentId;
    /**
     * @var null
     */
    private $profileId;
    /**
     * @var string
     */
    private $localKey;
    /**
     * @var null
     */
    private $table;
    /**
     * @var string
     */
    private $foreignKey;

    /**
     * DocumentsByLoggedCompanyCriteria constructor.
     * @param $companyId
     * @param null $documentId
     * @param null $profileId
     * @param string $localKey
     * @param null $table
     * @param string $foreignKey
     */
    public function __construct($companyId, $documentId = null, $profileId = null, $localKey = 'document_id', $table = null, $foreignKey = 'id')
    {
        $this->companyId = $companyId;
        $this->documentId = $documentId;
        $this->profileId = $profileId;
        $this->localKey = $localKey;
        $this->table = $table;
        $this->foreignKey = $foreignKey;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if (empty($this->table)) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        $query = $model->join('v_document_shared_with_company', function ($join) {
            $join->on("v_document_shared_with_company.{$this->localKey}", "=", "{$this->table}.{$this->foreignKey}");
            $join->where("v_document_shared_with_company.company_id", $this->companyId);
        });


        if (!empty($this->documentId)) {
            $query->where('v_document_shared_with_company.document_id', $this->documentId);
        }

        if (!empty($this->profileId)) {
            $query->where('v_document_shared_with_company.profile_id', $this->profileId);
        }

        return $query;
    }
}
