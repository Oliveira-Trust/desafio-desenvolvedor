<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\ImportDataFile;

/**
 * Class ImportFileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImportDataFileRepositoryEloquent extends BaseRepository implements ImportDataFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImportDataFile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
