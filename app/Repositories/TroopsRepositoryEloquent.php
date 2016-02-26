<?php

namespace App\Repositories;

use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TroopsRepository;
use App\Entities\Troop;

/**
 * Class TroopsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TroopsRepositoryEloquent extends Repository implements TroopsRepository, Restore
{
    use RestoreFunctionality;

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

    public function findByCode($code)
    {
        return $this->findByField('code', $code);
    }
}
