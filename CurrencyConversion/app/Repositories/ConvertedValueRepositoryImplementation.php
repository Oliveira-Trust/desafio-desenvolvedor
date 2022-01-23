<?php

namespace App\Repositories;

use App\Repositories\Contracts\ConvertedValueRepository;
use App\Helper\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ConvertedValueRepositoryImplementation implements ConvertedValueRepository
{
    use BaseEloquentRepository;



    /**
     * Create a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function CreateConvertedValue(array $data) :? Model
    {
        return $this->create($data);
    }


    /**
     * Update a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function updateConvertedValue(array $data, $id) :? Model
    {
        return $this->update($id, $data);
    }

}
