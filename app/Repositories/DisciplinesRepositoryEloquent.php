<?php

namespace App\Repositories;

use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DisciplinesRepository;
use App\Entities\Discipline;

/**
 * Class DisciplinesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DisciplinesRepositoryEloquent extends Repository implements DisciplinesRepository, Restore
{
    use RestoreFunctionality;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Discipline::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByFullName($fullName)
    {
        return $this->findByField('full_name', $fullName);
    }

    public function findByShortName($shortName)
    {
        return $this->findByField('short_name', $shortName);
    }
}
