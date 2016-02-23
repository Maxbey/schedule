<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SpecialtiesRepository;
use App\Entities\Specialty;

/**
 * Class SpecialtiesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SpecialtiesRepositoryEloquent extends BaseRepository implements SpecialtiesRepository
{
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

    public function findByName($name)
    {
        return $this->findByField('name', $name);
    }

    public function findByCode($code)
    {
        return $this->findByField('code', $code);
    }
}
