<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AudiencesRepository;
use App\Entities\Audience;

/**
 * Class AudiencesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AudiencesRepositoryEloquent extends BaseRepository implements AudiencesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audience::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByBuilding($building)
    {
        return $this->findByField('building', $building);
    }

    public function findByNumber($number)
    {
        return $this->findByField('number', $number);
    }
}
