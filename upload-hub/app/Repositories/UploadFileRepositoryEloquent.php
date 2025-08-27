<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\FileUploadRepositoryValidator;
use App\Models\UploadFile;

/**
 * Class FileUploadRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UploadFileRepositoryEloquent extends BaseRepository implements UploadFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UploadFile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
