<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FileUploadRepository;
use App\Validators\FileUploadRepositoryValidator;
use App\Models\FileUpload;

/**
 * Class FileUploadRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FileUploadRepositoryEloquent extends BaseRepository implements FileUploadRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FileUpload::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
