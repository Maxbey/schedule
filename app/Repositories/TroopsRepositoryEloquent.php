<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TroopsRepository;
use App\Entities\Troop;

/**
 * Class TroopsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TroopsRepositoryEloquent extends BaseRepository implements TroopsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Troop::class;
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
        return 'App\Presenters\TroopPresenter';
    }

    public function findByCode($code)
    {
        return $this->findByField('code', $code);
    }
}
