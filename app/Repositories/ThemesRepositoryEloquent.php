<?php

namespace App\Repositories;

use App\Repositories\Additions\Restore;
use App\Repositories\Additions\RestoreFunctionality;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ThemesRepository;
use App\Entities\Theme;

/**
 * Class ThemesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ThemesRepositoryEloquent extends Repository implements ThemesRepository, Restore
{
    use RestoreFunctionality;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Theme::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByTerm($termNumber)
    {
        return $this->findByField('term', $termNumber);
    }
}
