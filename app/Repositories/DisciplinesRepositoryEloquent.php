<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DisciplinesRepository;
use App\Entities\Discipline;

/**
 * Class DisciplinesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DisciplinesRepositoryEloquent extends BaseRepository implements DisciplinesRepository
{
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

    /**
     * Set the presenter
     *
     * @return string
     */
    public function presenter()
    {
        return 'App\Presenters\DisciplinePresenter';
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
