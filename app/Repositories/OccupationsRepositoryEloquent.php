<?php

namespace App\Repositories;

use App\Entities\Discipline;
use App\Entities\Troop;
use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OccupationsRepository;
use App\Entities\Occupation;

/**
 * Class OccupationsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OccupationsRepositoryEloquent extends Repository implements OccupationsRepository, Restore
{
    use RestoreFunctionality;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Occupation::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByDate($date)
    {
        return $this->findByField('date_of', $date);
    }

    public function findByTroopId($id)
    {
        return $this->findByField('troop_id', $id);
    }

    public function findByTroopAndDate(Troop $troop, Carbon $date)
    {
        return $this->findWhere([
            ['troop_id', '=', $troop->id],
            ['date_of', '=', $date->toDateTimeString()]
        ]);
    }
}
