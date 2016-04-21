<?php

namespace App\Repositories;

use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeachersRepository;
use App\Entities\Teacher;

/**
 * Class TeachersRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeachersRepositoryEloquent extends Repository implements TeachersRepository, Restore
{
    use RestoreFunctionality;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teacher::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByName($name)
    {
        return $this->findByField('name', $name);
    }
}
