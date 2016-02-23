<?php

namespace App\Repositories;

use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SpecialtiesRepository;
use App\Entities\Specialty;

/**
 * Class SpecialtiesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SpecialtiesRepositoryEloquent extends BaseRepository implements SpecialtiesRepository, Restore
{
    use RestoreFunctionality;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Specialty::class;
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
        return 'App\Presenters\SpecialtyPresenter';
    }

    public function findByName($name)
    {
        return $this->findByField('name', $name);
    }

    public function findByCode($code)
    {
        return $this->findByField('code', $code);
    }
}
