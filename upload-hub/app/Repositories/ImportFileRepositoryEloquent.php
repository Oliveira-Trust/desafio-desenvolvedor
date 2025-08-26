<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImportFileRepository;
use App\Validators\ImportFileValidator;
use App\Models\ImportFile;

/**
 * Class ImportFileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImportFileRepositoryEloquent extends BaseRepository implements ImportFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImportFile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
